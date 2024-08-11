#!/bin/bash

# Define colours
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Colour

# Get terminal width
TERM_WIDTH=$(tput cols)

# Function to detect the operating system
detect_os() {
	if [ "$(uname)" = "Linux" ]; then
		echo "Linux"
	elif [ "$(uname)" = "FreeBSD" ]; then
		echo "FreeBSD"
	elif [ "$(uname)" = "Darwin" ]; then
		echo "macOS"
	else
		echo "Unknown"
	fi
}

# Function to display progress
show_progress() {
	printf "${YELLOW}"
	printf "%-*s" $((TERM_WIDTH - 8)) "$1"
	printf "${NC}"
	sleep 1
	printf "${GREEN}[DONE]${NC}\n"
}

# ASCII Art with Claim
cat << "EOF"
 ________ ________  ________  ________ _________   _______     
|\  _____\\   __  \|\   __  \|\   ____\\___   ___\/  ___  \    
\ \  \__/\ \  \|\  \ \  \|\  \ \  \___\|___ \  \_/__/|_/  /|   
 \ \   __\\ \   _  _\ \   __  \ \  \       \ \  \|__|//  / /   
  \ \  \_| \ \  \\  \\ \  \ \  \ \  \____   \ \  \   /  /_/__  
   \ \__\   \ \__\\ _\\ \__\ \__\ \_______\  \ \__\ |\________\
    \|__|    \|__|\|__|\|__|\|__|\|_______|   \|__|  \|_______|
															   
   MODULAR CMS: FLEXIBLE, EFFICIENT, POWERFUL
														  
EOF

echo "Welcome to Fract2 Setup!"
echo "Detecting thy system..."
OS=$(detect_os)
echo -e "Detected OS: ${GREEN}$OS${NC}"
echo

# Define paths
SCRIPT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
PARENT_DIR="$(dirname "$SCRIPT_DIR")"
TARGET_DIR="$PARENT_DIR/fract2"

# Function to extract files
extract_files() {
	mkdir -p "$TARGET_DIR"
	tar -xvf "$SCRIPT_DIR/distribution.tar" -C "$TARGET_DIR"
	show_progress "Extracting files"
}

# Extract files from distribution.tar
extract_files

# Initialize Composer (if available)
if command -v composer > /dev/null 2>&1; then
	echo "Initializing Composer..."
	(cd "$TARGET_DIR" && composer install --quiet)
	show_progress "Composer initialization"
else
	echo -e "${YELLOW}Composer not found. Skipping dependency installation.${NC}"
	echo "Please install Composer and run 'composer install' in the Fract2 directory."
fi

# Git initialization (if git is available)
if command -v git > /dev/null 2>&1; then
	echo "Would you like to initialize a Git repository for your Fract2 installation? (y/n)"
	read -r init_git_response
	if [ "$init_git_response" = "y" ] || [ "$init_git_response" = "Y" ]; then
		(
			cd "$TARGET_DIR" &&
			git init &&
			git add . &&
			git commit -m "Initial Fract2 installation"
		)
		show_progress "Git repository initialization"
	else
		echo "Skipping Git initialization."
	fi
else
	echo -e "${YELLOW}Git not found. Skipping repository initialization.${NC}"
fi

echo
echo -e "${GREEN}Fract2 installation complete!${NC}"
echo "Thou canst now start customising thy Fract2 installation in: $TARGET_DIR"