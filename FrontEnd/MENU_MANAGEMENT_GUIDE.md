# Menu Management System - Complete Guide

## Overview
The Menu Management System is a comprehensive solution for managing restaurant menu items with full CRUD (Create, Read, Update, Delete) operations, categorization, and advanced features.

## Features Implemented

### 1. **Complete CRUD Operations**
- ✅ **Create**: Add new menu items with detailed information
- ✅ **Read**: View all menu items with filtering and search
- ✅ **Update**: Edit existing menu items
- ✅ **Delete**: Remove menu items with confirmation
- ✅ **Toggle Availability**: Quick toggle for item availability

### 2. **Category Management**
Menu items are organized into the following categories:
- **Starters** - Appetizers and small plates
- **Main Course** - Primary dishes
- **Desserts** - Sweet treats
- **Drinks** - Beverages

Each category displays:
- Icon representation
- Item count
- Visual highlight when selected

### 3. **Menu Item Details**
Each menu item includes:

#### Basic Information
- **Name** (required)
- **Description**
- **Price** (required)
- **Category**
- **Preparation Time** (in minutes)
- **Availability Status**

#### Advanced Details
- **Ingredients** (comma-separated list)
- **Allergens** (comma-separated list)
- **Dietary Information**:
  - Vegetarian flag
  - Vegan flag
- **Spicy Level**: None, Mild, Medium, Hot, Extra Hot

#### Media
- **Image**: Upload or URL
- Real-time image preview
- Fallback for invalid images

### 4. **Search & Filter**
- **Search**: Find items by name or description
- **Category Filter**: View items by category
- **Real-time Updates**: Instant filtering as you type

### 5. **User Interface Features**

#### Menu Grid
- Responsive card layout
- Visual indicators for availability
- Diet labels (Vegan, Vegetarian)
- Spicy level indicators
- Preparation time display
- Ingredient and allergen information
- Quick action menu (Edit, Delete, Toggle Availability)

#### Add/Edit Modal
- Comprehensive form with validation
- Image upload with preview
- Organized sections:
  - Basic Information
  - Image Upload
  - Additional Details
- Real-time form validation
- Success/Error notifications

#### Stats Dashboard
- Total Items
- Total Categories
- Available Items
- Out of Stock Items

### 6. **POS Integration**
- Add items to cart
- Quantity management
- Real-time total calculation
- Clear cart functionality

## File Structure

```
FrontEnd/src/components/admin/menu/
├── MenuPage.jsx              # Main menu management page
├── MenuHeader.jsx            # Header with stats and actions
├── CategoryFilter.jsx        # Category selection component
├── MenuGrid.jsx              # Grid display of menu items
├── AddMenuItemModal.jsx      # Add/Edit modal dialog
├── CartSection.jsx           # Shopping cart component
└── QuickActions.jsx          # Quick action buttons

FrontEnd/src/services/
└── apiService.js             # API service with menu endpoints
```

## API Service Methods

### Menu Service (`apiService.menu`)

```javascript
// Get all menu items with optional filters
getMenuItems(filters = {})
  // filters: { category, search, available }

// Get single menu item
getMenuItem(itemId)

// Create new menu item
createMenuItem(menuData)

// Update existing menu item
updateMenuItem(itemId, menuData)

// Delete menu item
deleteMenuItem(itemId)

// Toggle item availability
toggleAvailability(itemId)

// Get categories with counts
getCategories()

// Bulk update multiple items
bulkUpdate(itemIds, updateData)

// Upload menu item image
uploadImage(file)
```

## Usage Examples

### Adding a New Menu Item

```javascript
const newItem = {
  name: "Grilled Chicken",
  description: "Tender grilled chicken with herbs",
  price: 299,
  category: "main",
  preparationTime: 20,
  ingredients: ["Chicken", "Herbs", "Olive Oil"],
  allergens: ["None"],
  isVegetarian: false,
  isVegan: false,
  spicyLevel: "mild",
  available: true,
  image: "https://example.com/chicken.jpg"
};

await apiService.menu.createMenuItem(newItem);
```

### Filtering Menu Items

```javascript
// Get only main course items
const mainCourses = await apiService.menu.getMenuItems({ 
  category: 'main' 
});

// Search for items
const searchResults = await apiService.menu.getMenuItems({ 
  search: 'chicken' 
});

// Get only available items
const available = await apiService.menu.getMenuItems({ 
  available: true 
});
```

### Updating Menu Item

```javascript
await apiService.menu.updateMenuItem(itemId, {
  price: 349,  // Update price
  available: false  // Mark as unavailable
});
```

## Component Props

### MenuPage
No props required - self-contained component

### MenuHeader
```javascript
{
  stats: {
    totalItems: number,
    totalCategories: number,
    availableItems: number,
    outOfStock: number
  },
  onAddNewItem: () => void
}
```

### CategoryFilter
```javascript
{
  categories: Array<{
    id: string,
    name: string,
    icon: string,
    count?: number
  }>,
  selectedCategory: string,
  onCategoryChange: (categoryId) => void
}
```

### MenuGrid
```javascript
{
  items: Array<MenuItem>,
  onAddToCart: (item) => void,
  onEditItem: (item) => void,
  onDeleteItem: (itemId) => void,
  onToggleAvailability: (itemId) => void
}
```

### AddMenuItemModal
```javascript
{
  isOpen: boolean,
  onClose: () => void,
  onItemAdded: (itemData) => void,
  onItemUpdated: (itemId, itemData) => void,
  editingItem?: MenuItem | null,
  categories: Array<Category>
}
```

## Styling & Theming

### Color Scheme
- **Primary**: Orange (#f97316)
- **Success**: Green
- **Warning**: Yellow
- **Danger**: Red
- **Neutral**: Gray shades

### Responsive Design
- Mobile-first approach
- Breakpoints:
  - Mobile: < 768px
  - Tablet: 768px - 1024px
  - Desktop: > 1024px

### Animations
- Fade-in for notifications
- Slide-in for modals
- Hover effects on cards
- Scale transitions on buttons

## Notifications

The system includes a notification system for user feedback:
- ✅ Success: Green notification
- ❌ Error: Red notification
- ℹ️ Info: Blue notification

Auto-dismiss after 3 seconds.

## Validation Rules

### Required Fields
- Item Name
- Price (must be > 0)

### Optional but Recommended
- Description
- Category
- Preparation Time
- Image

### Image Upload
- Max file size: 5MB
- Accepted formats: All image types (jpg, png, gif, webp, etc.)
- Fallback to placeholder if invalid

## Backend Integration

### Current Status
The system currently uses **mock data** for development. All API calls return simulated responses with proper delays to mimic real API behavior.

### Migration to Real Backend

When your Laravel backend is ready:

1. **Update BASE_URL** in `apiService.js`:
```javascript
const BASE_URL = 'http://your-backend-url.com/api';
```

2. **Uncomment API calls** in `menuService`:
```javascript
// FROM:
return Promise.resolve(mockData);

// TO:
return apiCall('GET', '/menu/items', filters);
```

3. **Backend Endpoints Required**:
```
GET    /api/menu/items              - Get all menu items
GET    /api/menu/items/:id          - Get single item
POST   /api/menu/items              - Create item
PUT    /api/menu/items/:id          - Update item
DELETE /api/menu/items/:id          - Delete item
PATCH  /api/menu/items/:id/toggle   - Toggle availability
GET    /api/menu/categories         - Get categories
PATCH  /api/menu/items/bulk         - Bulk update
POST   /api/menu/upload-image       - Upload image
```

## Testing Checklist

- [ ] Add new menu item
- [ ] Edit existing item
- [ ] Delete item with confirmation
- [ ] Toggle item availability
- [ ] Search functionality
- [ ] Category filtering
- [ ] Add to cart
- [ ] Image upload
- [ ] Form validation
- [ ] Responsive design on mobile
- [ ] Error handling
- [ ] Success notifications

## Future Enhancements

Potential features for future versions:
- [ ] Drag-and-drop image upload
- [ ] Bulk operations (delete, update multiple items)
- [ ] Import/Export menu (CSV, Excel)
- [ ] Menu item duplicates
- [ ] Menu item variants (sizes, options)
- [ ] Nutritional information
- [ ] Menu item ratings
- [ ] Seasonal menu management
- [ ] Multi-language support
- [ ] Menu templates

## Troubleshooting

### Common Issues

**Issue**: Items not displaying
- Check console for errors
- Verify API service is properly imported
- Check network tab for API calls

**Issue**: Image not uploading
- Verify file size < 5MB
- Check file type is image
- Ensure upload endpoint is configured

**Issue**: Form validation not working
- Check required field values
- Verify price is a positive number
- Ensure category is selected

## Support

For issues or questions:
1. Check the console for error messages
2. Review this documentation
3. Check the component props
4. Verify API service configuration

## Version History

**v1.0.0** (Current)
- Complete CRUD operations
- Category management
- Advanced menu item details
- Search and filter
- Image upload
- POS cart integration
- Responsive design
- Notifications system

---

**Last Updated**: December 2025
**Maintained By**: Development Team
