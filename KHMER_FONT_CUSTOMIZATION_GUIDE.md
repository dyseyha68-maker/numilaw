# 🎨 **KHMER FONT CUSTOMIZATION GUIDE**

## **📍 WHERE TO CHANGE KHMER FONT STYLES**

You can customize Khmer fonts in **3 main locations** depending on what you want to change:

---

## **🔧 1. PRIMARY LOCATION: Font Variables File**

### **File**: `resources/css/font-variables.css` ⭐ **(RECOMMENDED)**

This is the **main place** to change Khmer fonts. All font styles are defined here as CSS variables.

### **🎯 Key Sections to Modify:**

#### **A. Change Khmer Font Family:**
```css
:root {
  /* KHMER FONTS - Change these to modify Khmer typography */
  --khmer-font-family: 'Battambang', 'Noto Sans Khmer', 'Khmer OS', sans-serif;
  --khmer-font-fallback: 'Khmer OS', 'Noto Sans Khmer', sans-serif;
}
```

#### **B. Popular Khmer Font Options:**
```css
/* Option 1: Siemreap (Traditional) */
--khmer-font-family: 'Siemreap', 'Noto Sans Khmer', sans-serif;

/* Option 2: Metal (Modern) */
--khmer-font-family: 'Metal', 'Noto Sans Khmer', sans-serif;

/* Option 3: Content (Bold) */
--khmer-font-family: 'Content', 'Noto Sans Khmer', sans-serif;

/* Option 4: Suwannaphum (Traditional) */
--khmer-font-family: 'Suwannaphum', 'Noto Sans Khmer', sans-serif;
```

#### **C. Adjust Khmer Font Weight:**
```css
:root {
  --khmer-font-weight-regular: 400;  /* Normal text */
  --khmer-font-weight-medium: 500;   /* Emphasis */
  --khmer-font-weight-bold: 700;      /* Headings */
}
```

#### **D. Adjust Khmer Letter Spacing:**
```css
:root {
  --khmer-letter-spacing-normal: 0.02em;      /* Standard spacing */
  --khmer-letter-spacing-tight: -0.01em;      /* Tighter spacing */
  --khmer-letter-spacing-relaxed: 0.04em;      /* More spacing */
}
```

#### **E. Adjust Khmer Line Height:**
```css
:root {
  --khmer-line-height-normal: 1.4;    /* Standard readability */
  --khmer-line-height-paragraph: 1.5;  /* Paragraph spacing */
  --khmer-line-height-heading: 1.3;     /* Heading spacing */
}
```

---

## **🎨 2. ALTERNATE LOCATION: Typography File**

### **File**: `resources/css/khmer-typography.css`

#### **Modify Khmer-Specific Classes:**
```css
/* Khmer headings */
.khmer-heading {
  font-family: 'Your-New-Font', 'Noto Sans Khmer', sans-serif;
  font-weight: var(--khmer-font-weight-bold);
  line-height: var(--khmer-line-height-heading);
  letter-spacing: var(--khmer-letter-spacing-heading);
}

/* Khmer paragraph text */
.khmer-text {
  font-family: 'Your-New-Font', 'Noto Sans Khmer', sans-serif;
  font-weight: var(--khmer-font-weight-regular);
  line-height: var(--khmer-line-height-paragraph);
  letter-spacing: var(--khmer-letter-spacing-paragraph);
}

/* Khmer navigation */
.khmer-nav {
  font-family: 'Your-New-Font', 'Noto Sans Khmer', sans-serif;
  font-weight: var(--khmer-font-weight-medium);
  line-height: var(--khmer-line-height-navigation);
}
```

---

## **🌐 3. CHANGE GOOGLE FONTS**

### **File**: `resources/views/layouts/public.blade.php`

#### **Modify Google Fonts Link:**
```html
<!-- Current Battambang Font -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Battambang:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<!-- Replace with your preferred Khmer fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Siemreap:wght@300;400;500;600;700&display=swap" rel="stylesheet">
```

#### **Popular Google Fonts for Khmer:**
- **Battambang** (Current - Traditional)
- **Noto Sans Khmer** (Google's primary Khmer font)
- **Koulen** (Bold, traditional)
- **Metal** (Modern, clean)

---

## **🔧 QUICK CUSTOMIZATION EXAMPLES**

### **Example 1: Make Khmer Text Bolder**
```css
/* In resources/css/font-variables.css */
:root {
  --khmer-font-weight-regular: 500;  /* Change from 400 to 500 */
  --khmer-font-weight-medium: 600;   /* Change from 500 to 600 */
}
```

### **Example 2: Increase Khmer Letter Spacing**
```css
/* In resources/css/font-variables.css */
:root {
  --khmer-letter-spacing-normal: 0.04em;      /* More spacing */
  --khmer-letter-spacing-paragraph: 0.05em;  /* Better readability */
}
```

### **Example 3: Change to Noto Sans Khmer**
```css
/* In resources/css/font-variables.css */
:root {
  --khmer-font-family: 'Noto Sans Khmer', 'Battambang', sans-serif;
}
```

---

## **📱 RESPONSIVE ADJUSTMENTS**

### **Mobile-Specific Khmer Settings:**
```css
/* In resources/css/font-variables.css - already included */
@media (max-width: 640px) {
  :root {
    /* Mobile Khmer adjustments */
    --khmer-line-height-normal: 1.5;    /* More spacing on mobile */
    --khmer-letter-spacing-normal: 0.015em;  /* Slightly tighter */
    --khmer-font-size-base: 1.1rem;     /* Larger text on mobile */
  }
}
```

---

## **🔄 APPLYING CHANGES**

### **Step 1**: Make your changes in the desired file
### **Step 2**: Clear Laravel cache
```bash
php artisan cache:clear
php artisan view:clear
```
### **Step 3**: Refresh your browser to see changes

---

## **🎯 RECOMMENDED APPROACH**

### **For Most Customizations:**
1. **Edit**: `resources/css/font-variables.css`
2. **Modify**: The CSS variables you want to change
3. **Test**: Refresh browser and check results

### **For Font Family Changes:**
1. **Update Google Fonts** in `resources/views/layouts/public.blade.php`
2. **Update CSS variables** in `resources/css/font-variables.css`
3. **Clear caches** and test

---

## **🌟 BEST PRACTICES**

### **✅ Do:**
- Use CSS variables for consistency
- Test on multiple screen sizes
- Ensure fallback fonts are included
- Clear caches after changes

### **❌ Don't:**
- Hard-code values throughout files
- Forget to update both font link and CSS variables
- Use too many different Khmer fonts (stick to 1-2)

---

## **🎨 CURRENT KHMER FONT SETUP**

- **Primary Font**: Battambang (Google Fonts)
- **Fallbacks**: Noto Sans Khmer, Khmer OS, system fonts
- **Weights**: 300, 400, 500, 600, 700 available
- **Optimization**: Local fallbacks, font-display: swap

---

**🎉 You now have complete control over your Khmer typography! Change any variable in `resources/css/font-variables.css` to customize the appearance.**