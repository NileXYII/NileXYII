
# Vape Shop Web Application

## Overview
This project is a web-based Vape Shop application built using **PHP**, **MySQL**, **HTML**, **CSS**, and **JavaScript** for the front-end and back-end development. Additionally, **Firebase** will be integrated for real-time features such as customer chat support and notifications. The application allows users to browse products, add items to their cart, place orders, and interact with customer support.

## Features
- **User Authentication**: Users can create accounts, log in, and manage their profiles.
- **Product Catalog**: Browse through a list of vape products with filtering options.
- **Shopping Cart**: Users can add products to their cart and manage their orders.
- **Order Management**: Admins can manage product inventory, update product listings, and process orders.
- **Real-time Notifications**: Firebase will handle real-time notifications for order status updates and promotional offers.
- **Customer Support Chat**: Users can contact support agents via real-time chat using Firebase.
- **Responsive Design**: The application will be fully responsive, working on both desktop and mobile devices.

## Tech Stack
### Front-End
- **HTML**: Markup language used for the structure of the web pages.
- **CSS**: Stylesheet used for styling and layout.
- **JavaScript**: Enhances interactivity, handles dynamic content and communication with the server.
- **Bootstrap** (optional): For a responsive and mobile-friendly design.

### Back-End
- **PHP**: Server-side language for handling business logic, user authentication, and managing requests.
- **MySQL**: Relational database for storing user data, product details, and order information.

### Real-time Features
- **Firebase**: Integrated for real-time chat support and notification system to notify users of order updates and promotions.

## Installation
To run this project locally, follow these steps:

### Prerequisites
- **XAMPP** or **WAMP** server to run PHP and MySQL locally.
- Firebase account for real-time functionality.
- Modern web browser (Chrome, Firefox, etc.).

### Setup Instructions
1. **Clone the Repository**  
   ```
   git clone https://github.com/your-username/vape-shop.git
   cd vape-shop
   ```

2. **Database Configuration**  
   - Create a MySQL database using phpMyAdmin or MySQL CLI.
   - Import the provided SQL file located in the `database/` folder to create the necessary tables.
   - Update the database credentials in the `config.php` file with your local MySQL settings.

3. **Install Firebase SDK**  
   Add Firebase SDK to your HTML files to handle real-time functionality:
   ```html
   <script src="https://www.gstatic.com/firebasejs/9.0.0/firebase-app.js"></script>
   <script src="https://www.gstatic.com/firebasejs/9.0.0/firebase-database.js"></script>
   <script src="https://www.gstatic.com/firebasejs/9.0.0/firebase-auth.js"></script>
   ```

4. **Run the Application**  
   - Start your local PHP server using XAMPP or WAMP.
   - Navigate to the root directory of the project.
   - Open the application in your browser: `http://localhost/vape-shop`.

## Usage
### For Users:
1. **Sign Up/Login**: Create an account or log in using existing credentials.
2. **Browse Products**: Navigate through various categories of vape products.
3. **Add to Cart**: Select products and add them to your cart.
4. **Place Order**: Complete the checkout process and place an order.
5. **Customer Support**: Use the chat feature for real-time support.

### For Admin:
1. **Product Management**: Add, edit, or remove products from the store.
2. **Order Management**: View and manage incoming orders, update order statuses.
3. **Notifications**: Send real-time notifications about offers and order updates using Firebase.

## Contributing
Contributions are welcome! Please fork this repository and submit a pull request for any feature additions or bug fixes.

## License
This project is licensed under the MIT License.

## Contact
For any questions or inquiries, please contact:
- **Email**: jasperfernandezvegas01@gmail.com
- **GitHub**: github.com/NileXYII

---

Feel free to adjust any sections according to your project's specific details!
