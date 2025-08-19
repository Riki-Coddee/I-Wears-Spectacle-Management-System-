# 🕶️ I-Wears - Online Spectacles Store

![System Architecture](https://github.com/Riki-Coddee/I-Wears-Spectacle-Management-System-/blob/2dc036c6dc795d0146b91d2b2c83424fec094a92/System%20Architecture.png?raw=true)

## 📌 Introduction
A web-based solution revolutionizing eyewear retail with seamless inventory management, customer interactions, and real-time data processing.

## 🎯 Problem Statement
Traditional stores struggle with:
- 📜 Manual paper-based systems
- 📊 Inventory tracking challenges
- 👥 Inefficient customer management
- ⏱️ Lack of real-time sales data

## 🚀 Objectives
- ✔️ Instant spectacles availability check
- 🔍 Personalized eyewear recommendations
- ✉️ Email notifications for orders/account

## 🌐 Scope & Limitations
| ✅ Scopes | ⚠️ Limitations |
|-----------|----------------|
| Nationwide access in Nepal | No payment processing |
| Expanded retailer reach | No virtual try-on feature |
| Convenient home shopping | |

## 🔧 Development
**Methodology:** Iterative Model  
![Iterative Model](https://github.com/Riki-Coddee/I-Wears-Spectacle-Management-System-/blob/main/Iterative%20Methodlogy.png?raw=true)

## 🧩 System Analysis
### Requirement Analysis
- 📝 Functional Requirements  
![Use Case Diagram](https://github.com/Riki-Coddee/I-Wears-Spectacle-Management-System-/blob/6c0b120b2d36e942185655d7b27c44229550c477/Use%20case%20diagram.png?raw=true)
  - User registration/login
  - Product ordering
  - Cart/wishlist
  - Feedback system

- ⚙️ Non-Functional Requirements
  - Intuitive UI
  - Cross-device accessibility
  - Simple navigation

## ✔️ Feasibility Study
| Type | Status | Details |
|------|--------|---------|
| Economic | ✅ | Low-cost implementation |
| Operational | ✅ | Internet-dependent |
| Technical | ✅ | Platform-independent |
| Schedule | ✅ | 62-day timeline |

**Project Timeline:**
| Task | Duration |
|------|---------|
| Requirement Gathering | 11 days |
| Design & Development | 13 days |
| Testing | 17 days |
| Implementation | 20 days |
| Documentation | 62 days |

![Gantt Chart](https://github.com/Riki-Coddee/I-Wears-Spectacle-Management-System-/blob/b1db4f25560fb08359e6359679d09d4a55c2da38/Gannt%20Chart.png?raw=true)

## 🗃️ Data Modeling
![ER Diagram](https://github.com/Riki-Coddee/I-Wears-Spectacle-Management-System-/blob/df7dbf185d506782746f9fdadc4c365c06809811/Entity%20Relationship%20Diagram.png?raw=true)

## 🔄 Process Flow
![Context Diagram](https://github.com/Riki-Coddee/I-Wears-Spectacle-Management-System-/blob/60f40efda7e6169396e9dff0ccd3b140b82d5034/Context%20level%20diagram.png?raw=true)
![Level 1 DFD](https://github.com/Riki-Coddee/I-Wears-Spectacle-Management-System-/blob/bf71a87d2a442a289dc62249cb50f2f82e2d8c2a/Level%20Data%20flow%20diagram.png?raw=true)

## 🏗️ System Architecture
Three-tier architecture:
1. **Presentation Layer**: HTML/CSS/JS
2. **Application Layer**: PHP
3. **Database Layer**: MySQL

# 🗃️ Database Design & Implementation

## Database Schema
![Database Schema](https://github.com/Riki-Coddee/I-Wears-Spectacle-Management-System-/blob/b587118a908690903d45e0e762e7c4ff9e66a5d5/Database%20Schema%20Design.png?raw=true)

**Key Tables & Relationships:**
- `login_table` ↔ `usercart` (user management)
- `products` ↔ `productsuppliers` (inventory tracking)
- `suppliers` ↔ `order_product` (supply chain)
- `admin` ↔ `order_product` (order processing)
- `order_product` ↔ `order_product_history` (order tracking)

## Physical Data Model
![Physical Diagram](https://github.com/Riki-Coddee/I-Wears-Spectacle-Management-System-/blob/155059164d24f64eb13f4998c62c99dafb7e0d5e/Physical%20Diagram.png?raw=true)

**Core Databases:**
1. **Customer DB**: User profiles & contact info
2. **Inventory DB**: Spectacle stock & variants
3. **Admin DB**: System access controls

# 💻 Implementation

## Tech Stack
| Layer | Technologies |
|-------|--------------|
| **Frontend** | HTML5, CSS3, JavaScript, jQuery |
| **Backend** | PHP 8+ |
| **Database** | MySQL 8.0 |

## Core Modules
1. **User Module**  
   - Account creation
   - Product browsing
   - Order tracking

2. **Admin Module**  
   - Inventory control
   - Order management
   - System configuration

3. **Order Management**  
   - Automated status updates
   - Shipping integration
   - Notification system

4. **Inventory System**  
   - Real-time stock alerts
   - Supplier management
   - Product categorization

# 🧪 Testing Strategy
- **Unit Testing**: Individual component validation
- **Integration Testing**: Module interaction checks
- **User Acceptance**: Real-world scenario testing

# 📚 Lessons Learned
- Time management in SDLC phases
- Balancing features vs deadlines
- Progressive enhancement approach

# 🎯 Conclusion & Future Roadmap

## Current Achievements
✔️ Robust inventory management  
✔️ Seamless order processing  
✔️ Multi-role access system  

## Planned Enhancements
- 🗺️ Google Maps integration for delivery tracking
- 👓 AR-powered virtual try-on feature
- 📱 Dedicated mobile application
- 🩺 Eyecare professional portal
- 🔄 Continuous UX improvements

## Appendix
![Login Page](https://github.com/Riki-Coddee/I-Wears-Spectacle-Management-System-/blob/9ff7353dc0e2eb71ef4d7c9e4f8bf632a2a89fc8/Log%20In%20Page.png)
![Signup Page](https://github.com/Riki-Coddee/I-Wears-Spectacle-Management-System-/blob/9ff7353dc0e2eb71ef4d7c9e4f8bf632a2a89fc8/Sign%20Up%20Page.png)
![Home Page](https://github.com/Riki-Coddee/I-Wears-Spectacle-Management-System-/blob/9ff7353dc0e2eb71ef4d7c9e4f8bf632a2a89fc8/Homepage.png)
![About-Us Page](https://github.com/Riki-Coddee/I-Wears-Spectacle-Management-System-/blob/9ff7353dc0e2eb71ef4d7c9e4f8bf632a2a89fc8/Contact%20Page.png)
![Product Page](https://github.com/Riki-Coddee/I-Wears-Spectacle-Management-System-/blob/9ff7353dc0e2eb71ef4d7c9e4f8bf632a2a89fc8/Product%20Page.png)
![Contact Page]()
![MyProfile Page](https://github.com/Riki-Coddee/I-Wears-Spectacle-Management-System-/blob/9ff7353dc0e2eb71ef4d7c9e4f8bf632a2a89fc8/My%20Profile%20Page.png)
![My Wishlist Page](https://github.com/Riki-Coddee/I-Wears-Spectacle-Management-System-/blob/9ff7353dc0e2eb71ef4d7c9e4f8bf632a2a89fc8/My%20Wishlist%20Page.png)
![My Cart Page](https://github.com/Riki-Coddee/I-Wears-Spectacle-Management-System-/blob/9ff7353dc0e2eb71ef4d7c9e4f8bf632a2a89fc8/MyCart%20Page.png)

![Admin Login Page](https://github.com/Riki-Coddee/I-Wears-Spectacle-Management-System-/blob/9ff7353dc0e2eb71ef4d7c9e4f8bf632a2a89fc8/Admin%20login%20page.png)
![Admin Dashboard Page](https://github.com/Riki-Coddee/I-Wears-Spectacle-Management-System-/blob/9ff7353dc0e2eb71ef4d7c9e4f8bf632a2a89fc8/Admin%20Dashboard.png)
![Admin Reports Page](https://github.com/Riki-Coddee/I-Wears-Spectacle-Management-System-/blob/9ff7353dc0e2eb71ef4d7c9e4f8bf632a2a89fc8/Admin%20View%20Admin%20Page.png)
![Admin View Product Page](https://github.com/Riki-Coddee/I-Wears-Spectacle-Management-System-/blob/9ff7353dc0e2eb71ef4d7c9e4f8bf632a2a89fc8/Admin%20View%20Product.png)
![Admin Add Product Page](https://github.com/Riki-Coddee/I-Wears-Spectacle-Management-System-/blob/9ff7353dc0e2eb71ef4d7c9e4f8bf632a2a89fc8/Admin%20Edit%20Product.png)
![Admin View Suppliers Page](https://github.com/Riki-Coddee/I-Wears-Spectacle-Management-System-/blob/9ff7353dc0e2eb71ef4d7c9e4f8bf632a2a89fc8/Admin%20View%20Supplier%20Page.png)
![Admin Add Suppliers Page](https://github.com/Riki-Coddee/I-Wears-Spectacle-Management-System-/blob/9ff7353dc0e2eb71ef4d7c9e4f8bf632a2a89fc8/Admin%20Add%20Supplier%20Page.png)
![Admin View Purchase Orders Page](https://github.com/Riki-Coddee/I-Wears-Spectacle-Management-System-/blob/9ff7353dc0e2eb71ef4d7c9e4f8bf632a2a89fc8/Admin%20View%20Purchase%20Order%20Page.png)
![Admin Create Purchase Orders Page](https://github.com/Riki-Coddee/I-Wears-Spectacle-Management-System-/blob/9ff7353dc0e2eb71ef4d7c9e4f8bf632a2a89fc8/Admin%20Create%20Purchase%20Order%20Page.png)
![Admin View Users Page](https://github.com/Riki-Coddee/I-Wears-Spectacle-Management-System-/blob/9ff7353dc0e2eb71ef4d7c9e4f8bf632a2a89fc8/Admin%20View%20Users%20Page.png)
![Admin View Admin Page](https://github.com/Riki-Coddee/I-Wears-Spectacle-Management-System-/blob/9ff7353dc0e2eb71ef4d7c9e4f8bf632a2a89fc8/Admin%20View%20Admin%20Page.png)
![Admin View User Orders Page](https://github.com/Riki-Coddee/I-Wears-Spectacle-Management-System-/blob/9ff7353dc0e2eb71ef4d7c9e4f8bf632a2a89fc8/Admin%20View%20User%20Orders%20Page.png)
![Admin View User Message Page](https://github.com/Riki-Coddee/I-Wears-Spectacle-Management-System-/blob/9ff7353dc0e2eb71ef4d7c9e4f8bf632a2a89fc8/Admin%20View%20User%20Message%20Page.png)
![Admin View User Feedback Page](https://github.com/Riki-Coddee/I-Wears-Spectacle-Management-System-/blob/9ff7353dc0e2eb71ef4d7c9e4f8bf632a2a89fc8/Admin%20View%20User%20FeedBack%20Page.png)

