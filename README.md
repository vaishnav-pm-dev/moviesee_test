## **MovieSee – User Authentication & OMDB API Integration**  

### **Overview**  
This is a PHP-based movie application that allows users to register, log in, search for movies using the OMDB API, and save their favorite movies.  

### **Features**  
✅ **User Authentication** – Secure registration & login system with hashed passwords.  
✅ **Movie Search** – Fetch movie details from the OMDB API.  
✅ **Favorite Movies** – Users can add and manage favorite movies.  
✅ **Responsive UI** – Modern design with a user-friendly interface.  
✅ **Secure Storage** – Uses MySQL with proper relationships and security practices.  

### **Live Demo**  
🔗 [Deployed Application](moviesee.ct.ws) *(Replace with actual URL)*  

### **Installation**  

1. **Clone the repository**  
   ```sh
   git clone https://github.com/yourusername/movie-app.git
   cd movie-app
   ```
2. **Create a MySQL database** and import `database.sql`.  
3. **Update `config.php`** with your database credentials.  
4. **Start a local server** (XAMPP, MAMP, or LAMP).  
5. **Access the application** via `http://localhost/moviesee`.  

### **Tech Stack**  
- Backend: **PHP 8+**  
- Database: **MySQL 8+**  
- Frontend: **HTML, CSS, JavaScript**  
- API: **OMDB API**  

### **Database Schema**  
#### **Users Table**  
```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```
#### **Favorite Movies Table**  
```sql
CREATE TABLE favorite_movies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    movie_id VARCHAR(50) NOT NULL,
    movie_title VARCHAR(255) NOT NULL,
    poster_url VARCHAR(255),
    added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

### **Deployment**  
1. Use a free hosting service (e.g., **InfinityFree, 000WebHost, Render**).  
2. Set up a free MySQL database.  
3. Upload files and configure database settings.  
4. Share the hosted URL.  

### **Contributing**  
Feel free to fork the repo and submit a pull request!  

### **License**  
This project is open-source and free to use.  

Let me know if you want any modifications! 🚀
