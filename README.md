# Blog CMS

A simple and elegant Content Management System (CMS) for managing blog posts, built with PHP and MySQL.

## Features

- Create new blog posts with titles and content
- Upload and display images with posts
- Responsive and modern design with gradient backgrounds
- Delete existing posts
- Chronological post display (newest first)
- Clean and user-friendly interface

## Prerequisites

- XAMPP (or similar local server environment)
- PHP 7.0+
- MySQL/MariaDB
- Web browser

## Installation

1. Clone or download this repository to your XAMPP's `htdocs` folder
2. Import the database structure:
   - Create a new database named `blog_cms` in phpMyAdmin
   - Use the SQL commands from `sql.txt` to create the required table

3. Configure the database connection:
   - The default configuration in `db.php` uses:
     - Host: localhost
     - User: root
     - Password: (empty)
     - Database: blog_cms

## Project Structure

```
blog_cms/
├── index.php          # Main page displaying all posts
├── create_post.php    # Form for creating new posts
├── save_post.php      # Handles post creation
├── delete_post.php    # Handles post deletion
├── db.php            # Database configuration
├── style.css         # Stylesheets
└── uploads/          # Directory for uploaded images
```

## Usage

1. Access the blog through your web browser: `http://localhost/blogs_cms/blog_cms/`
2. Click "Crear nuevo post" to create a new blog post
3. Fill in the title and content, optionally upload an image
4. View all posts on the main page
5. Delete posts using the delete button on each post

## Features Detail

### Post Creation
- Title and content fields
- Optional image upload
- Real-time file name display
- Form validation

### Post Display
- Responsive layout
- Image preview
- Publication date
- Delete functionality with confirmation

### Styling
- Modern gradient background
- Card-based post layout
- Responsive design
- Hover effects
- Custom file upload styling

## Security Features

- SQL injection prevention using prepared statements
- HTML escaping for output
- Image upload validation
- Confirmation dialogs for deletions

## Contributing

Feel free to fork this project and submit pull requests for any improvements.

## License

This project is open source and available under the MIT License.
