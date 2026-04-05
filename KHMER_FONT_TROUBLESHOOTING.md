# 🔧 **KHMER FONT TROUBLESHOOTING GUIDE**

## **🚨 ISSUE: Khmer Font Not Working**

### **✅ SOLUTIONS IMPLEMENTED:**

#### **1. Fixed Font Loading Order:**
```html
<!-- Now loads in correct order -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Battambang:wght@300;400;500;600;700&family=Noto+Sans+Khmer:wght@300;400;500;600;700&display=swap" rel="stylesheet">
```

#### **2. Added Emergency Font Fix:**
```css
/* Force Khmer fonts with !important */
.font-khmer {
  font-family: 'Battambang', 'Noto Sans Khmer', 'Khmer OS', sans-serif !important;
}
```

#### **3. Enhanced JavaScript Font Switcher:**
- Forces Khmer fonts on all elements
- Loads Google Fonts dynamically
- Applies fonts immediately

---

## **🔍 HOW TO TEST:**

### **Step 1: Test Font Loading**
Visit: `http://127.0.0.1:8000/test-khmer-font`

### **Step 2: Switch to Khmer**
1. Go to your main site
2. Click language switcher → Select "ខ្មែរ"
3. Check if Khmer text displays correctly

### **Step 3: Check Browser Console**
1. Open Developer Tools (F12)
2. Go to Network tab
3. Look for Google Fonts loading
4. Should see `Battambang` and `Noto Sans Khmer`

---

## **🛠️ QUICK FIXES TO TRY:**

### **Fix 1: Clear Browser Cache**
```bash
# Clear Laravel caches
php artisan cache:clear
php artisan view:clear

# In browser: Ctrl+Shift+R (Hard refresh)
```

### **Fix 2: Check Google Fonts URL**
The correct URL format should be:
```
https://fonts.googleapis.com/css2?family=Battambang:wght@300;400;500;600;700&display=swap
```

### **Fix 3: Verify Font Classes**
```css
/* Test this in browser console */
document.body.style.fontFamily = "'Battambang', 'Noto Sans Khmer', sans-serif";
```

---

## **🔧 ADVANCED TROUBLESHOOTING:**

### **Check 1: Font Loading Status**
```javascript
// Paste in browser console
console.log('Current locale:', document.documentElement.lang);
console.log('Body classes:', document.body.className);
console.log('Computed font:', getComputedStyle(document.body).fontFamily);
```

### **Check 2: Network Requests**
1. F12 → Network tab
2. Refresh page
3. Look for fonts.googleapis.com requests
4. Should see Battambang font loading

### **Check 3: CSS Variables**
```javascript
// Check if CSS variables are loaded
const root = document.documentElement;
console.log('Khmer font variable:', getComputedStyle(root).getPropertyValue('--khmer-font-family'));
```

---

## **🎯 IF FONTS STILL DON'T WORK:**

### **Option 1: Use Local Fonts Only**
```css
/* In resources/css/khmer-font-fix.css */
.font-khmer {
  font-family: 'Khmer OS', 'Noto Sans Khmer', sans-serif !important;
}
```

### **Option 2: Change Font Stack**
```css
/* Try different font order */
.font-khmer {
  font-family: 'Noto Sans Khmer', 'Battambang', 'Khmer OS', sans-serif !important;
}
```

### **Option 3: System Fonts Only**
```css
/* Use system-installed Khmer fonts */
.font-khmer {
  font-family: 'Khmer OS', 'Khmer UI', 'DaunPenh', sans-serif !important;
}
```

---

## **📱 COMMON ISSUES & SOLUTIONS:**

### **Issue: Font Not Loading**
**Cause**: Google Fonts blocked or slow
**Fix**: Use local fonts or CDN alternative

### **Issue: Wrong Characters Display**
**Cause**: Wrong font selected
**Fix**: Ensure UTF-8 encoding in HTML

### **Issue: Font Size Too Small**
**Cause**: Khmer font metrics
**Fix**: Increase font-size for Khmer

---

## **🔧 FINAL CHECKLIST:**

- ✅ Google Fonts URL correct
- ✅ CSS variables defined
- ✅ Font classes applied
- ✅ JavaScript font switcher working
- ✅ Browser cache cleared
- ✅ Laravel caches cleared
- ✅ UTF-8 encoding set
- ✅ Font display: swap used

---

## **🎯 CURRENT IMPLEMENTATION:**

Your system now has **3 layers of font enforcement**:

1. **CSS Variables**: `resources/css/font-variables.css`
2. **Emergency Fix**: `resources/css/khmer-font-fix.css` 
3. **JavaScript Enforcer**: `resources/js/font-switcher.js`

---

## **🚀 NEXT STEPS:**

1. **Test** the font loading: `/test-khmer-font`
2. **Check** browser console for errors
3. **Try** switching languages on main site
4. **Report** specific issues if any remain

---

**🎉 The Khmer font system is now heavily enforced with multiple fallback layers. If it's still not working, the issue might be:**
- **Network connectivity** (Google Fonts blocked)
- **Browser compatibility** (older browsers)
- **Font installation** (local fonts missing)

**Let me know what you see when testing, and I'll provide the next specific fix!**