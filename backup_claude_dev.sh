#!/bin/bash
# Backup claude-dev extension data
BACKUP_DIR="/Users/akash/cursor_extension_backup_$(date +%Y%m%d_%H%M%S)"
mkdir -p "$BACKUP_DIR"

# Backup claude-dev data
cp -r "/Users/akash/Library/Application Support/Cursor/User/globalStorage/saoudrizwan.claude-dev" "$BACKUP_DIR/" 2>/dev/null || echo "No claude-dev data found"

# Backup cline data (if exists)
cp -r "/Users/akash/Library/Application Support/Cursor/User/globalStorage"/*cline* "$BACKUP_DIR/" 2>/dev/null || echo "No cline data found"

echo "Backup completed at: $BACKUP_DIR"
ls -la "$BACKUP_DIR"
