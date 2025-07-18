# Red-Knot Consulting Website

A professional, mobile-first immigration consultancy website built for Dubai-based Red-Knot Consulting, specializing in blue-collar work visa applications.

## 🌟 Features

- **Mobile-First Design**: Optimized for smartphone users (70% of target audience)
- **Cultural Adaptation**: Arabic language support with RTL design
- **WhatsApp Integration**: Direct communication channel for instant customer support
- **Lead Generation**: Free visa eligibility assessment tool
- **SEO Optimized**: Dubai-specific keywords and AI search optimization
- **High Performance**: Fast loading times with Core Web Vitals optimization
- **Professional Design**: UAE-inspired color palette and trust-building elements

## 🚀 Quick Start

### 1. Local Development Setup

```bash
# Navigate to the website directory
cd redknot-website

# Open with any local server (examples below)

# Option 1: Python
python -m http.server 8000

# Option 2: Node.js (http-server)
npx http-server

# Option 3: VS Code Live Server extension
# Right-click index.html and select "Open with Live Server"
```

Visit `http://localhost:8000` to view the website locally.

### 2. File Structure

```
redknot-website/
├── index.html          # Homepage
├── about.html           # About Us page
├── services.html        # Services page (to be created)
├── css/
│   └── style.css        # Custom styles with UAE theme
├── js/
│   └── main.js          # Interactive functionality
├── images/
│   ├── redknot.jpg      # Logo
│   └── redknot-immigration_2-*.avif  # Hero image
├── docs/
│   └── llm.txt          # AI search optimization
└── README.md            # This file
```

## 🎨 Design System

### Color Palette (UAE Cultural Alignment)

- **UAE Blue** (#0A4C96): Trust, professionalism
- **UAE Gold** (#B68A35): Success, prosperity
- **Pure White** (#FFFFFF): Cleanliness, fresh starts
- **Charcoal** (#2D3748): Primary text

### Typography

- **Primary Font**: Roboto (professional, clean)
- **Fallback**: System fonts for faster loading

## 📱 Key Features

### 1. Free Visa Eligibility Assessment

- Interactive form with scoring algorithm
- Instant results with recommendations
- WhatsApp integration for follow-up

### 2. WhatsApp Integration

- Floating button with pulse animation
- Service-specific message templates
- Click tracking for analytics

### 3. Multi-language Support

- English/Arabic language toggle
- RTL support for Arabic content
- Persistent language preference

### 4. Contact Forms

- Netlify Forms integration for free form handling
- Telegram bot notifications (optional)
- Real-time validation feedback

## 🌐 Deployment Options

### Option 1: Netlify (Recommended - Free)

1. **Connect GitHub Repository**

   ```bash
   # Initialize git repository
   git init
   git add .
   git commit -m "Initial commit"
   git remote add origin https://github.com/yourusername/redknot-website
   git push -u origin main
   ```

2. **Deploy to Netlify**

   - Visit [netlify.com](https://netlify.com)
   - Click "New site from Git"
   - Connect your GitHub repository
   - Deploy settings:
     - Build command: (leave empty)
     - Publish directory: (leave empty)
   - Click "Deploy site"

3. **Custom Domain Setup**
   - Purchase domain: `redknotconsulting.com`
   - In Netlify dashboard: Site settings → Domain management
   - Add custom domain and configure DNS

### Option 2: Vercel (Alternative - Free)

1. **Deploy via Vercel CLI**

   ```bash
   npm i -g vercel
   vercel --prod
   ```

2. **Or use GitHub integration**
   - Import project from GitHub at [vercel.com](https://vercel.com)

### Option 3: GitHub Pages (Backup)

1. **Enable GitHub Pages**
   - Repository Settings → Pages
   - Source: Deploy from a branch
   - Branch: main
   - Folder: / (root)

## ⚙️ Configuration

### 1. WhatsApp Integration

Update phone numbers in:

- `index.html` (line ~100, ~624)
- `about.html` (WhatsApp buttons)
- `js/main.js` (default country code)

```html
<!-- Replace 971XXXXXXXXX with actual number -->
<a href="https://wa.me/971XXXXXXXXX?text=..."></a>
```

### 2. Contact Information

Update in all HTML files:

- Phone numbers
- Email addresses
- Office address
- Business license number

### 3. Telegram Bot (Optional)

In `js/main.js`, replace:

```javascript
const botToken = "YOUR_BOT_TOKEN";
const chatId = "YOUR_CHAT_ID";
```

### 4. Google Analytics (Optional)

Add before closing `</head>` tag:

```html
<!-- Google Analytics -->
<script
  async
  src="https://www.googletagmanager.com/gtag/js?id=GA_MEASUREMENT_ID"
></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag() {
    dataLayer.push(arguments);
  }
  gtag("js", new Date());
  gtag("config", "GA_MEASUREMENT_ID");
</script>
```

## 📊 SEO Optimization

### 1. Meta Tags

Already implemented with Dubai-specific keywords:

- Work visa Dubai
- UAE immigration services
- Blue collar visa Dubai

### 2. Structured Data

JSON-LD markup for local business included in `index.html`

### 3. AI Search Optimization

`docs/llm.txt` file optimized for AI search engines

### 4. Performance

- WebP images for faster loading
- Minified CSS/JS from CDN
- Font optimization with preconnect

## 🔧 Customization Guide

### Adding New Services

1. Edit `index.html` services section
2. Add corresponding service icons (Font Awesome)
3. Update navigation if needed

### Changing Colors

Update CSS variables in `css/style.css`:

```css
:root {
  --uae-blue: #0a4c96;
  --uae-gold: #b68a35;
  /* ... other colors */
}
```

### Adding Languages

1. Create content blocks with language-specific IDs
2. Update `switchLanguage()` function in `js/main.js`
3. Add language button to header

### Form Customization

1. Modify form fields in HTML
2. Update validation logic in `js/main.js`
3. Configure Netlify Forms settings

## 📈 Analytics & Tracking

### Performance Metrics

- Core Web Vitals monitoring
- Mobile performance optimization
- Loading speed tracking

### Conversion Tracking

- Form submission rates
- WhatsApp click tracking
- Assessment completion rates

### SEO Monitoring

- Google Search Console setup
- Keyword ranking tracking
- Local search visibility

## 🔒 Security Features

- SSL certificate (automatic with Netlify)
- XSS protection headers
- CSRF protection for forms
- Input validation and sanitization
- Secure external link handling

## 🐛 Troubleshooting

### Common Issues

1. **Forms not working**

   - Check Netlify Forms configuration
   - Verify form attributes: `data-netlify="true"`

2. **WhatsApp links not working**

   - Verify phone number format: +971XXXXXXXXX
   - Check URL encoding in links

3. **Language toggle not working**

   - Ensure JavaScript is loaded
   - Check browser console for errors

4. **Images not loading**
   - Verify image paths are correct
   - Check image file formats (WebP support)

### Performance Issues

- Use browser DevTools Lighthouse audit
- Optimize images further if needed
- Check CDN loading for CSS/JS

## 📞 Support

For technical support or customization requests:

- Email: [your-email@domain.com]
- Documentation: This README file
- Design Reference: Development Strategy documents

## 📄 License

This website is built specifically for Red-Knot Consulting. All design elements and content are proprietary.

## 🎯 Success Metrics

**30-Day Targets:**

- 100+ unique monthly visitors
- 5+ contact form submissions
- First WhatsApp inquiry
- Google ranking for company name

**90-Day Targets:**

- 1,000+ monthly visitors
- 50+ qualified leads
- Top 10 ranking for primary keywords
- First successful visa application

---

**Built with ❤️ for Red-Knot Consulting - Dubai's Leading Blue-Collar Immigration Specialists**
