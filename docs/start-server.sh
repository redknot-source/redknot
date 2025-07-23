#!/bin/bash

# Red-Knot Consulting Website - Local Development Server
# This script starts a local server for testing the website

echo "🚀 Starting Red-Knot Consulting Website..."
echo "📍 Location: $(pwd)"
echo ""

# Check if Python is available
if command -v python3 &> /dev/null; then
    echo "✅ Python 3 found - Starting server on http://localhost:8000"
    echo "📱 Test on mobile: http://[your-ip]:8000"
    echo ""
    echo "Press Ctrl+C to stop the server"
    echo "==============================================="
    python3 -m http.server 8000
elif command -v python &> /dev/null; then
    echo "✅ Python found - Starting server on http://localhost:8000"
    echo "📱 Test on mobile: http://[your-ip]:8000"
    echo ""
    echo "Press Ctrl+C to stop the server"
    echo "==============================================="
    python -m http.server 8000
else
    echo "❌ Python not found. Please install Python or use one of these alternatives:"
    echo ""
    echo "📦 Node.js option:"
    echo "   npx http-server"
    echo ""
    echo "🔧 VS Code option:"
    echo "   Install 'Live Server' extension"
    echo "   Right-click index.html → 'Open with Live Server'"
    echo ""
    echo "🌐 Direct file option:"
    echo "   Open index.html directly in your browser"
    echo "   (Some features may not work without a server)"
fi 