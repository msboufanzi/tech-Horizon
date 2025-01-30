# Tech Horizon - Online Magazine Management Application

## Overview

Tech Horizon is a web application designed to manage an online magazine focused on advanced technologies. The application provides a personalized and intuitive user experience, allowing subscribers, contributors, and administrators to actively participate in content dissemination and management. The platform is built using modern web technologies and follows the MVC architecture to ensure a clean and maintainable codebase.

## Features

### User Roles and Functionalities

- **Guest (Unregistered User):**
  - Explore theme information.
  - View public magazine issues.
  - Request to become a subscriber.

- **Subscriber:**
  - View all magazine issues in a personalized space.
  - Manage theme subscriptions (add/remove).
  - Search previously viewed articles using filters.
  - Propose articles for publication and track their status (Rejected, In Progress, Accepted, Published).
  - Rate articles and add comments.

- **Theme Manager:**
  - Manage theme-related subscriptions.
  - Review article proposals from subscribers.
  - Propose articles for upcoming issues.
  - View theme-specific statistics.
  - Moderate discussions related to theme articles.

- **Editor:**
  - Manage magazine issues (publish, delete, activate/deactivate).
  - Manage users (add, modify, block, or delete subscribers or theme managers).
  - Activate/deactivate issues or articles after publication.
  - View global statistics on subscribers, theme managers, issues, themes, and articles.

### Key Functionalities

- **Article and Theme Browsing:** Users can explore available content based on themes and magazine issues.
- **Subscription Management:** Subscribers can subscribe, modify, or cancel their subscriptions to different themes.
- **Personalized Recommendations:** An algorithm suggests articles based on the subscriber's browsing history and preferences.
- **Article Submission and Tracking:** Subscribers can submit articles for publication and track their status.
- **Advanced Administration:** Editors and theme managers have tools to manage articles, moderate discussions, and analyze content and subscriber statistics.

## Technologies Used

### Backend
- **Framework:** Laravel (PHP)
- **Database:** MySQL
- **Authentication:** Laravel's built-in authentication system

### Frontend
- **HTML/CSS:** For structuring and styling the web pages.
- **JavaScript:** For dynamic interactions and real-time updates.
- **Blade Templates:** Laravel's templating engine for dynamic content rendering.

### Development Tools
- **XAMPP:** Local server environment for development.
- **Composer:** Dependency management for PHP.
- **PHPUnit:** For unit testing.
- **Laravel Dusk:** For browser testing and automation.

## Project Structure

The application follows the **MVC (Model-View-Controller)** architecture provided by Laravel:

- **Models:** Represent the entities of the application (e.g., User, Article, Theme, Issue).
- **Views:** Handle the presentation layer using Blade templates.
- **Controllers:** Manage user requests and interact with models to retrieve data.

### Key Directories
- **app/:** Contains models and controllers.
- **database/:** Contains migrations and seeders for database schema and initial data.
- **public/:** Contains CSS and JavaScript files for frontend styling and interactivity.
- **resources/views/:** Contains Blade templates for the user interface.
- **routes/:** Contains route definitions for the application.

## Installation and Setup

### Prerequisites
- PHP 8.x
- Composer
- MySQL
- XAMPP (or any local server environment)

### Steps to Run the Project

1. **Clone the Repository:**
   ```bash
   git clone https://github.com/your-username/tech-horizon.git
   cd tech-horizon
   ```

2. **Install Dependencies:**
   ```bash
   composer install
   ```

3. **Set Up the Database:**
   - Create a MySQL database named `tech_horizon`.
   - Update the `.env` file with your database credentials:
     ```
     DB_DATABASE=tech_horizon
     DB_USERNAME=your_db_username
     DB_PASSWORD=your_db_password
     ```

4. **Run Migrations and Seeders:**
   ```bash
   php artisan migrate 
   ```
   and
   ```bash
   php artisan db:seed --class=UserSeeder
   php artisan db:seed --class=ThemeSeeder
   php artisan db:seed --class=ArticleSeeder
   php artisan db:seed --class=CommentSeeder
   php artisan db:seed --class=RatingSeeder
   ```

6. **Start the Development Server:**
   ```bash
   php artisan serve
   ```

7. **Access the Application:**
   Open your browser and navigate to `http://localhost:8000`.

## Testing

The application has been tested using:

- **PHPUnit:** For unit testing models and business logic.
- **Laravel Dusk:** For browser testing and simulating user interactions.
- **Manual Testing:** For validating the user interface and ensuring a smooth user experience.

## Security Measures

- **Authentication and Session Management:** Laravel's built-in authentication system is used to manage user sessions securely.
- **Middleware:** Ensures that only authenticated users can access protected routes.
- **Password Hashing:** User passwords are hashed using Laravel's bcrypt function.
- **CSRF Protection:** Laravel automatically generates and validates CSRF tokens for forms.

## Deployment

The application can be deployed on any server that supports PHP and MySQL. For local development, XAMPP is recommended. For production, consider using services like Laravel Forge, DigitalOcean, or Heroku.

## Screenshots

### Home Page
![Home Page](https://hebbkx1anhila5yf.public.blob.vercel-storage.com/image-YZjHXZJkmv270pVsR1KWIzeZbOQkpL.png)
*The home page features a modern design with a matrix-style background and welcoming message about exploring technology.*

### Authentication Page
![Authentication Page](https://hebbkx1anhila5yf.public.blob.vercel-storage.com/image-6Oc7qPp6LF7NevoQNrdbtn2X6C3iuD.png)
*The authentication page offers a clean, split-panel design with sign-in form and welcome message.*

### Public Articles Page
![Public Articles Page](https://hebbkx1anhila5yf.public.blob.vercel-storage.com/WhatsApp%20Image%202025-01-29%20at%2018.21.00_99f9252b.jpg-OPJ6xt21ay79Nzrsz7d3Uo75KWeybE.jpeg)
*The public articles page showcases various technology articles in a card-based layout, covering topics from cybersecurity to cloud computing.*

### Theme Manager Dashboard
![Theme Manager Dashboard](https://hebbkx1anhila5yf.public.blob.vercel-storage.com/WhatsApp%20Image%202025-01-29%20at%2018.24.01_201d6f5d.jpg-ndaPZupspK0BSrubFltU2XJRacbCu7.jpeg)
*The theme manager dashboard provides comprehensive tools for managing articles, users, themes, and viewing statistics.*

Each interface demonstrates our commitment to:
- Clean, modern design
- Intuitive user experience
- Responsive layouts
- Professional presentation of technical content

## Conclusion

Tech Horizon is a robust and scalable web application designed to manage an online magazine. It offers a wide range of features for different user roles, ensuring a personalized and secure experience. The project demonstrates the effective use of modern web technologies and best practices in web development.

## Future Enhancements

- Implement an interactive comment system.
- Enhance subscription management features.
- Optimize the user interface for a more immersive experience.
- Add more advanced analytics and reporting tools for editors and theme managers.

---

Tech Horizon is a project developed by:

- Sohaib Ek Khatab
- Mohamed Said Boufanzi
- Edrissi Noussaiba
- El Akhal Aya

Under the guidance of:

- Prof. M'hamed AIT KBIR
- Prof. Yasyn EL YUSUFI

For any inquiries or contributions, feel free to contact us or open an issue on the repository.
