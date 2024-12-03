from fpdf import FPDF

# Create a PDF instance
pdf = FPDF()
pdf.set_auto_page_break(auto=True, margin=15)
pdf.add_page()
pdf.set_font("Arial", size=12)

# Title
pdf.set_font("Arial", style="B", size=16)
pdf.cell(0, 10, "Motomates Website Architecture", ln=True, align="C")
pdf.ln(10)

# Content in tree format
content = """
Motomates
├── Home
│   ├── Hero Section (Rotating Banner)
│   ├── Service Categories (Grid Layout)
│   │   ├── On-Demand Auto Services
│   │   ├── Car Cleaning & Detailing
│   │   ├── Driver Services
│   │   ├── Rentals & Accessories
│   │   ├── Marketplace for Used Cars
│   │   ├── Emergency Services
│   ├── Testimonials (Customer Reviews)
│   ├── Why Choose Us (Benefits Highlight)
│   └── Call-to-Actions (Book a Service, Learn More)
├── Services
│   ├── On-Demand Auto Services
│   │   ├── Mechanical Services
│   │   │   ├── Car Repairs
│   │   │   ├── Battery Replacement
│   │   │   ├── Oil Change
│   │   │   └── Brake Service
│   │   ├── Non-Mechanical Services
│   │       ├── Tire Check
│   │       ├── Paint Touch-Up
│   │       └── Windshield Repair
│   ├── Car Cleaning & Detailing
│   │   ├── Interior Cleaning
│   │   │   ├── Vacuuming
│   │   │   └── Upholstery Cleaning
│   │   ├── Exterior Cleaning
│   │       ├── Washing
│   │       └── Waxing
│   └── Driver Services
│       ├── Occasional Driver Hire
│       ├── Private Driving Lessons
│       └── Self-Learning Facilities
├── Rentals & Accessories
│   ├── Car Rentals
│   │   ├── Short-Term Rentals
│   │   └── Self-Drive Options
│   ├── Travel Equipment Rentals
│   └── Accessories for Sale
├── Marketplace for Used Cars
│   ├── Browse Listings
│   ├── Sell My Car
│   │   ├── Upload Details
│   │   └── Value My Car
│   └── Verified Car Listings
├── Emergency Services
│   ├── Roadside Assistance
│   ├── Towing
│   ├── Lockout Help
│   └── Fuel Delivery
├── About Us
│   ├── Mission & Philosophy
│   ├── Core Values
│   └── Our Team
├── Contact Us
│   ├── Contact Form
│   ├── Email Address
│   └── Phone Number
├── User Account
│   ├── Sign In
│   ├── Register
│   └── Profile Management
└── Footer
    ├── Quick Links
    ├── Social Media Icons
    ├── Newsletter Subscription
    └── Contact Information
"""

# Add content to the PDF
pdf.set_font("Arial", size=12)
pdf.multi_cell(0, 10, content)

# Save the PDF
file_path = "/mnt/data/Motomates_Website_Architecture.pdf"
pdf.output(file_path)

file_path
