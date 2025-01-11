## CMS Project - Readme

This project aims to build a Content Management System (CMS) , allowing users to sign up and manage content ✍️. Here's what you'll find:

### Project Structure

- **migrations** (): Database schema definitions using Laravel migrations.
- **models** (): Eloquent models representing database tables and their relationships.
- **factories (optional)** (): Classes to generate test data for articles and PDFs (optional).
- **seeders (optional)** (): Scripts to populate the database with initial data (optional).
- **controllers (later)** (️): Handle incoming requests and interact with models (later).
- **routes (later)** (️): Define URLs and their corresponding controllers (later).
- **views (later)** (): User interface templates for displaying data (later).

### Roadmap ️

1. ✅ **Database Schema (Migrations):** Completed!

    - Users table (with email, password, admin status)
    - Articles table (with title, description, thumbnail, foreign key to user)
    - Article PDFs table (with path, foreign key to article, optional hash)
    - `cascadeOnDelete` used on foreign keys for data integrity.

2. ✅ **Eloquent Models:** Completed!

    - User model with casts for `is_admin` (boolean).
    - Article model with relationships:
        - `belongsTo` User (author)
        - `hasMany` ArticlePdf
    - ArticlePdf model with `belongsTo` Article relationship.

3. ✅ **Factories & Seeders:** Completed!

    - Define factories to generate test data for articles and PDFs.
    - Use seeders to populate the database with initial data.

4. **Application Logic (later):** (️) (️) () (later)

    - Implement controllers for user registration, login, article management, and admin functionality.
    - Define routes for accessing different functionalities.
    - Create views for user interface elements and data display.

5. **Authentication & Authorization (later):** () (later)
    - Implement user authentication (login, logout).
    - Implement authorization to restrict access based on user roles (admin vs. regular user).

### Additional Notes

- This project explores a simplified CMS concept, focusing on core functionalities.
- Consider using Breeze/Jetstream for a quicker authentication setup (optional).
- Soft deletes (optional) can be implemented for data recovery capabilities.

**Feel free to contribute and extend this project further!**
