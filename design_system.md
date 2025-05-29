# Twedl.com UI Design System

## Overview
This document outlines the design system for Twedl.com's UI improvements. The goal is to create a modern, visually appealing, and user-friendly interface that enhances the event discovery experience.

## Current UI Assessment
- The application uses Laravel Blade templates with Flux components
- Minimal custom CSS/JS, relying mostly on default styling
- Basic sidebar layout with limited visual hierarchy
- Lacks visual appeal and modern design elements
- No consistent color scheme or typography system

## Design System Components

### Color Palette

#### Primary Colors
- Primary: #6366F1 (Indigo)
- Primary Hover: #4F46E5
- Primary Light: #EEF2FF

#### Secondary Colors
- Secondary: #EC4899 (Pink)
- Secondary Hover: #DB2777
- Secondary Light: #FCE7F3

#### Neutral Colors
- Background: #FFFFFF
- Card Background: #F9FAFB
- Dark Background: #111827
- Dark Card: #1F2937

#### Text Colors
- Text Primary: #111827
- Text Secondary: #4B5563
- Text Light: #9CA3AF
- Text Dark: #F9FAFB
- Text Dark Secondary: #D1D5DB

#### Status Colors
- Success: #10B981
- Warning: #F59E0B
- Error: #EF4444
- Info: #3B82F6

### Typography

#### Font Families
- Primary: 'Inter', sans-serif
- Secondary: 'Poppins', sans-serif
- Monospace: 'JetBrains Mono', monospace

#### Font Sizes
- xs: 0.75rem (12px)
- sm: 0.875rem (14px)
- base: 1rem (16px)
- lg: 1.125rem (18px)
- xl: 1.25rem (20px)
- 2xl: 1.5rem (24px)
- 3xl: 1.875rem (30px)
- 4xl: 2.25rem (36px)
- 5xl: 3rem (48px)

#### Font Weights
- Light: 300
- Regular: 400
- Medium: 500
- Semibold: 600
- Bold: 700

### Spacing System
- 0: 0
- 1: 0.25rem (4px)
- 2: 0.5rem (8px)
- 3: 0.75rem (12px)
- 4: 1rem (16px)
- 5: 1.25rem (20px)
- 6: 1.5rem (24px)
- 8: 2rem (32px)
- 10: 2.5rem (40px)
- 12: 3rem (48px)
- 16: 4rem (64px)
- 20: 5rem (80px)
- 24: 6rem (96px)

### Border Radius
- none: 0
- sm: 0.125rem (2px)
- DEFAULT: 0.25rem (4px)
- md: 0.375rem (6px)
- lg: 0.5rem (8px)
- xl: 0.75rem (12px)
- 2xl: 1rem (16px)
- full: 9999px

### Shadows
- sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05)
- DEFAULT: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06)
- md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06)
- lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05)
- xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)
- 2xl: 0 25px 50px -12px rgba(0, 0, 0, 0.25)

## Component Design

### Buttons
- Primary: Filled background with primary color
- Secondary: Outlined with secondary color
- Tertiary: Text-only with hover effect
- Sizes: sm, md, lg
- States: default, hover, active, disabled
- Icons: Left, right, or icon-only options

### Cards
- Default: White background with subtle shadow
- Elevated: Stronger shadow for emphasis
- Bordered: Light border with minimal shadow
- Interactive: Hover effects for clickable cards
- Event cards: Special design for event listings

### Forms
- Inputs: Clean, bordered design with focus states
- Labels: Clear positioning above inputs
- Validation: Clear error states with messages
- Checkboxes/Radios: Custom styled for consistency
- Select menus: Enhanced dropdown experience

### Navigation
- Sidebar: Redesigned with better visual hierarchy
- Mobile navigation: Optimized for touch
- Active states: Clear indication of current page
- Dropdowns: Enhanced user menu experience

### Tables
- Clean borders and spacing
- Alternating row colors for readability
- Responsive design for mobile viewing
- Sorting and filtering visual indicators

## Responsive Breakpoints
- sm: 640px
- md: 768px
- lg: 1024px
- xl: 1280px
- 2xl: 1536px

## Animations & Transitions
- Duration: 150ms, 300ms, 500ms
- Easing: ease-in-out, ease-in, ease-out
- Hover effects: Subtle scale or color changes
- Page transitions: Fade effects
- Loading states: Skeleton loaders and spinners

## Implementation Strategy
1. Set up Tailwind CSS with custom configuration
2. Create base component styles
3. Implement dark mode support
4. Ensure accessibility compliance
5. Build responsive layouts
6. Add animation and transition effects
