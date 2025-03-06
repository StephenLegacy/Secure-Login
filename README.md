

# 🛡️ Secure User Registration System (PHP & SQLite)

This is a **secure user registration system** built using **PHP, SQLite, and SweetAlert2** for enhanced user experience. It includes features like **password hashing, profile picture uploads, and duplicate account prevention**.

## 🚀 Features
- 🔐 Secure password storage using `password_hash()`
- 📸 Profile picture upload with validation (JPG, PNG, GIF)
- 🛡️ Prevention of duplicate usernames and emails
- 🎨 User-friendly alerts using **SweetAlert2**
- 📂 SQLite database for lightweight storage

## 🛠️ Installation

1. **Clone the repository**
   ```sh
   git clone https://github.com/StephenLegacy/Secure-Login.git
   cd user-registration-php
   ```

2. **Start a local PHP server**
   ```sh
   php -S localhost:8000
   ```

3. **Open in your browser**
   ```
   http://localhost:8000/register.php
   ```

## 📄 Usage
1. **Register a new user** by filling out the form in `register.php`
2. **Login (if implemented)** using `login.php`
3. **View and manage users** via the SQLite database (`users.db`)  using the sqlite viewer VsCode extension


## 🔒 Security Considerations
- Uses **prepared statements** to prevent SQL injection.
- Encrypts passwords with **bcrypt hashing**.
- Validates uploaded profile pictures to prevent security risks.

## 📜 License
This project is **MIT Licensed**. Feel free to use and modify it.

## 👨‍💻 Author
Developed by **Stephen Oloo**  
💼 [LinkedIn](https://www.linkedin.com/in/stephenoloolegacyio) | 🌍 [Portfolio](#)

---

⭐ **If you found this project useful, give it a star on GitHub!** ⭐
```

