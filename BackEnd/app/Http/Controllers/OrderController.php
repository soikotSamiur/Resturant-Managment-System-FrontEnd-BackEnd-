<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // Get all orders
    public function index()
    {
        $orders = Order::with('orderItems')->orderBy('created_at', 'desc')->get();
        
        $ordersArray = $orders->map(function($order) {
            return [
                'id' => $order->id,
                'customerName' => $order->customer_name,
                'phone' => $order->phone,
                'email' => $order->email,
                'type' => $order->type,
                'tableNumber' => $order->table_number,
                'guests' => $order->guests,
                'address' => $order->address,
                'specialInstructions' => $order->special_instructions,
                'items' => $order->orderItems->map(function($item) {
                    return [
                        'id' => $item->id,
                        'name' => $item->name,
                        'price' => (float) $item->price,
                        'quantity' => $item->quantity
                    ];
                }),
                'total' => (float) $order->total,
                'status' => $order->status,
                'progress' => $order->progress,
                'timestamp' => $order->created_at->toISOString(),
                'orderTime' => $order->created_at->diffForHumans()
            ];
        });
        
        return response()->json([
            'success' => true,
            'data' => $ordersArray
        ]);
    }
    
    // Get single order
    public function show($id)
    {
        $order = Order::with('orderItems')->findOrFail($id);
        
        return response()->json([
            'success' => true,
            'data' => [
                'id' => $order->id,
                'customerName' => $order->customer_name,
                'phone' => $order->phone,
                'email' => $order->email,
                'type' => $order->type,
                'tableNumber' => $order->table_number,
                'guests' => $order->guests,
                'address' => $order->address,
                'specialInstructions' => $order->special_instructions,
                'items' => $order->orderItems->map(function($item) {
                    return [
                        'id' => $item->id,
                        'name' => $item->name,
                        'price' => (float) $item->price,
                        'quantity' => $item->quantity
                    ];
                }),
                'total' => (float) $order->total,
                'status' => $order->status,
                'progress' => $order->progress,
                'timestamp' => $order->created_at->toISOString(),
                'orderTime' => $order->created_at->diffForHumans()
            ]
        ]);
    }
    
    // Create new order
    public function store(Request $request)
    {
        $request->validate([
            'customerName' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'type' => 'required|in:dine-in,takeaway',
            'tableNumber' => 'nullable|integer',
            'guests' => 'nullable|integer',
            'address' => 'nullable|string',
            'specialInstructions' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.id' => 'required|integer',
            'items.*.name' => 'required|string',
            'items.*.price' => 'required|numeric',
            'items.*.quantity' => 'required|integer|min:1',
            'total' => 'required|numeric|min:0'
        ]);
        
        DB::beginTransaction();
        
        try {
            // Create order
            $order = Order::create([
                'customer_name' => $request->customerName,
                'phone' => $request->phone,
                'email' => $request->email,
                'type' => $request->type,
                'table_number' => $request->tableNumber,
                'guests' => $request->guests,
                'address' => $request->address,
                'special_instructions' => $request->specialInstructions,
                'total' => $request->total,
                'status' => 'pending',
                'progress' => 0
            ]);
            
            // Create order items
            foreach ($request->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_item_id' => $item['id'],
                    'name' => $item['name'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity']
                ]);
            }
            
            DB::commit();
            
            // Load order items for response
            $order->load('orderItems');
            
            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $order->id,
                    'customerName' => $order->customer_name,
                    'phone' => $order->phone,
                    'email' => $order->email,
                    'type' => $order->type,
                    'tableNumber' => $order->table_number,
                    'guests' => $order->guests,
                    'address' => $order->address,
                    'specialInstructions' => $order->special_instructions,
                    'items' => $order->orderItems->map(function($item) {
                        return [
                            'id' => $item->menu_item_id,
                            'name' => $item->name,
                            'price' => (float) $item->price,
                            'quantity' => $item->quantity
                        ];
                    }),
                    'total' => (float) $order->total,
                    'status' => $order->status,
                    'progress' => $order->progress,
                    'timestamp' => $order->created_at->toISOString(),
                    'orderTime' => $order->created_at->diffForHumans()
                ],
                'message' => 'Order created successfully'
            ], 201);
            
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to create order: ' . $e->getMessage()
            ], 500);
        }
    }
    
    // Update existing order
    public function update(Request $request, $id)
    {
        $request->validate([
            'customerName' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'type' => 'required|in:dine-in,takeaway',
            'tableNumber' => 'nullable|integer',
            'guests' => 'nullable|integer',
            'address' => 'nullable|string',
            'specialInstructions' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.id' => 'required|integer',
            'items.*.name' => 'required|string',
            'items.*.price' => 'required|numeric',
            'items.*.quantity' => 'required|integer|min:1',
            'total' => 'required|numeric|min:0'
        ]);
        
        DB::beginTransaction();
        
        try {
            $order = Order::findOrFail($id);
            
            // Update order
            $order->update([
                'customer_name' => $request->customerName,
                'phone' => $request->phone,
                'email' => $request->email,
                'type' => $request->type,
                'table_number' => $request->tableNumber,
                'guests' => $request->guests,
                'address' => $request->address,
                'special_instructions' => $request->specialInstructions,
                'total' => $request->total
            ]);
            
            // Delete existing order items
            $order->orderItems()->delete();
            
            // Create new order items
            foreach ($request->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_item_id' => $item['id'],
                    'name' => $item['name'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity']
                ]);
            }
            
            DB::commit();
            
            // Load order items for response
            $order->load('orderItems');
            
            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $order->id,
                    'customerName' => $order->customer_name,
                    'phone' => $order->phone,
                    'email' => $order->email,
                    'type' => $order->type,
                    'tableNumber' => $order->table_number,
                    'guests' => $order->guests,
                    'address' => $order->address,
                    'specialInstructions' => $order->special_instructions,
                    'items' => $order->orderItems->map(function($item) {
                        return [
                            'id' => $item->menu_item_id,
                            'name' => $item->name,
                            'price' => (float) $item->price,
                            'quantity' => $item->quantity
                        ];
                    }),
                    'total' => (float) $order->total,
                    'status' => $order->status,
                    'progress' => $order->progress,
                    'timestamp' => $order->created_at->toISOString(),
                    'orderTime' => $order->created_at->diffForHumans()
                ],
                'message' => 'Order updated successfully'
            ]);
            
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to update order: ' . $e->getMessage()
            ], 500);
        }
    }
    
    // Update order status
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,preparing,ready,completed,cancelled'
        ]);
        
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        
        // Update progress based on status
        switch ($request->status) {
            case 'pending':
                $order->progress = 0;
                break;
            case 'preparing':
                $order->progress = 50;
                break;
            case 'ready':
                $order->progress = 75;
                break;
            case 'completed':
                $order->progress = 100;
                break;
            case 'cancelled':
                $order->progress = 0;
                break;
        }
        
        $order->save();
        
        $order->load('orderItems');
        
        return response()->json([
            'success' => true,
            'data' => [
                'id' => $order->id,
                'customerName' => $order->customer_name,
                'phone' => $order->phone,
                'email' => $order->email,
                'type' => $order->type,
                'tableNumber' => $order->table_number,
                'guests' => $order->guests,
                'address' => $order->address,
                'specialInstructions' => $order->special_instructions,
                'items' => $order->orderItems->map(function($item) {
                    return [
                        'id' => $item->menu_item_id,
                        'name' => $item->name,
                        'price' => (float) $item->price,
                        'quantity' => $item->quantity
                    ];
                }),
                'total' => (float) $order->total,
                'status' => $order->status,
                'progress' => $order->progress,
                'timestamp' => $order->created_at->toISOString(),
                'orderTime' => $order->created_at->diffForHumans()
            ],
            'message' => 'Order status updated successfully'
        ]);
    }
    
    // Delete order
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Order deleted successfully'
        ]);
    }
}

