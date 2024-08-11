#!/bin/bash

# Define paths
SCRIPT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
DEV_DIR="$SCRIPT_DIR"
DIST_DIR="$DEV_DIR/distribution"
SETUP_DIR="$(dirname "$DEV_DIR")/fract2-setup"

# Function to display progress
show_progress() {
	echo "Processing: $1"
}

# Function to create tar packages
create_tar_package() {
	local src_dir="$1"
	local tar_name="$(basename "$src_dir")"
	
	tar -cvf "$DIST_DIR/packages/$tar_name" -C "$src_dir" .
	show_progress "Created $tar_name"
}

# Ensure the distribution directory exists
mkdir -p "$DIST_DIR"

# Clear the distribution directory, keeping fract2-setup.sh
find "$DIST_DIR" -mindepth 1 -not -name 'fract2-setup.sh' -delete

# Create necessary subdirectories
mkdir -p "$DIST_DIR"/{system/bootstrap,packages,config,templates}

# Copy core files
cp "$DEV_DIR/index.php" "$DIST_DIR/" 2>/dev/null || show_progress "index.php not found"
cp "$DEV_DIR/README.md" "$DIST_DIR/" 2>/dev/null || show_progress "README.md not found"

# Copy system files
if [ -d "$DEV_DIR/system/bootstrap" ]; then
	cp "$DEV_DIR/system/bootstrap/"* "$DIST_DIR/system/bootstrap/" 2>/dev/null
	show_progress "Copied bootstrap files"
else
	show_progress "Bootstrap directory not found"
fi

if [ -d "$DEV_DIR/system/core.tar" ]; then
	tar -cvf "$DIST_DIR/system/core.tar" -C "$DEV_DIR/system/core.tar" .
	show_progress "Created core.tar"
else
	show_progress "core.tar directory not found"
fi

# Process packages
for package_dir in "$DEV_DIR/packages/"*.tar; do
	if [ -d "$package_dir" ]; then
		create_tar_package "$package_dir"
	fi
done

# Copy config
cp "$DEV_DIR/config/config.yaml" "$DIST_DIR/config/" 2>/dev/null || show_progress "config.yaml not found"

# Copy templates
if [ -d "$DEV_DIR/templates" ]; then
	cp -R "$DEV_DIR/templates/"* "$DIST_DIR/templates/" 2>/dev/null
	show_progress "Copied templates"
else
	show_progress "Templates directory not found"
fi

# Create distribution.tar in the distribution directory
tar -cvf "$DIST_DIR/distribution.tar" -C "$DIST_DIR" --exclude="distribution.tar" --exclude="fract2-setup.sh" .
show_progress "Created distribution.tar"

# Ensure the setup directory exists and is empty
mkdir -p "$SETUP_DIR"
rm -rf "$SETUP_DIR"/*

# Copy only the necessary files to fract2-setup
cp "$DIST_DIR/fract2-setup.sh" "$SETUP_DIR/"
cp "$DIST_DIR/distribution.tar" "$SETUP_DIR/"
show_progress "Copied setup files to fract2-setup"

# Clean up the distribution directory, keeping only fract2-setup.sh
find "$DIST_DIR" -mindepth 1 -not -name 'fract2-setup.sh' -delete
show_progress "Cleaned up distribution directory"

echo "Distribution package and setup script created successfully in $SETUP_DIR!"
echo "Contents of $SETUP_DIR:"
ls -l "$SETUP_DIR"