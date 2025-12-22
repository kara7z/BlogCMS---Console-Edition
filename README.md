# BlogCMS Console Edition — By CodeCrafters Digital
A command-line Content Management System for blog management that demonstrates pure Object-Oriented Programming principles.  
Developed as part of the **PHP OOP Fundamentals** brief at CodeCrafters Digital for MediaPress International.

---
## Table of Contents
- [Project Overview](#project-overview)
- [Educational Objectives](#educational-objectives)
- [User Personas](#user-personas)
- [Screenshots](#screenshots)
- [Main Features (PHP OOP)](#main-features-php-oop)
- [Technologies Used](#technologies-used)
- [Development Workflow](#development-workflow)
- [Installation & Usage](#installation--usage)
- [Deployment](#deployment)
- [License](#license)

---

## Project Overview
**BlogCMS Console Edition** is a professional command-line blog management system built entirely with **Object-Oriented Programming** principles in PHP 8+.  
Designed for system administrators at MediaPress International, this project transforms complex content management requirements into a **clean, extensible, terminal-based application**.

The focus is on **role-based permissions**, **CRUD operations**, **class relationships**, **encapsulation**, **inheritance**, and **polymorphism** — all implemented without frameworks or design patterns, showcasing pure OOP fundamentals.

---

## Educational Objectives
- Master the four pillars of OOP: Encapsulation, Inheritance, Polymorphism, and Abstraction
- Design and implement UML diagrams (Use Cases and Class Diagrams)
- Build a role-based permission system with granular access control
- Create full **CRUD** operations for articles, users, categories, and comments
- Apply PHP 8+ strict typing and modern language features
- Develop a clean, maintainable architecture ready for web interface extension
- Implement comprehensive testing scenarios with real-world use cases
- Practice professional development workflow: planning → design → implementation → testing → documentation

---

## User Personas
The system serves four distinct user roles with different permission levels:

| Persona | Role | Permissions | Use Case |
|---------|------|-------------|----------|
| **Amina** | Administrator | ALL actions | Manage users, content, and system configuration |
| **Thomas** | Editor-in-Chief | Articles + Categories + Comments | Supervise content quality and organization |
| **Léa** | Writer/Author | Own articles only | Create and publish personal content |
| **Marco** | Visitor | Read-only | Study system for future web integration |

### Permission Matrix

| Action | Visitor | Author | Editor | Administrator |
|--------|---------|--------|--------|---------------|
| Read articles | ✅ | ✅ | ✅ | ✅ |
| Create article | ❌ | ✅ (own) | ✅ (all) | ✅ (all) |
| Modify article | ❌ | ✅ (own) | ✅ (all) | ✅ (all) |
| Delete article | ❌ | ✅ (own) | ✅ (all) | ✅ (all) |
| Publish article | ❌ | ✅ (own) | ✅ (all) | ✅ (all) |
| Create category | ❌ | ❌ | ✅ | ✅ |
| Create comments | ✅ | ✅ | ❌ | ❌ |
| Manage users | ❌ | ❌ | ❌ | ✅ |
| Moderate comments | ❌ | ❌ | ✅ | ✅ |

---

## Screenshots
![Use Case Diagram](Preview/Diagramme%20de%20Use%20Cases.png)
*UML Use Case Diagram showing actor interactions*

![Class Diagram](Preview/)
*Complete UML Class Diagram with relationships and multiplicities*

![Trello Planning Board](Preview/)
*5-day project planning with 11 organized cards*

---

## Main Features (PHP OOP)

### 1. **Authentication & Permission System**
- Role-based access control (RBAC) with 4 role levels
- Secure authentication with session management
- Granular permission checking for every action
- Permission matrix implementation with strict enforcement

### 2. **Article Management System**
- **Create**: Authors can write new articles with title, content, and categories
- **Read**: All users can view published articles
- **Update**: Edit articles based on role permissions
- **Delete**: Remove articles with permission validation
- **Publish/Unpublish**: Control article visibility
- Multi-category assignment support

### 3. **User Management** (Admin Only)
- Create new users with role assignment
- Update user information and roles
- Delete user accounts
- List all system users
- Secure password handling

### 4. **Category System**
- Create and manage content categories
- Assign multiple categories to articles
- Category-based organization
- Category CRUD operations (Editor & Admin)

### 5. **Comment System**
- Add comments to published articles
- Comment moderation for editors
- User-based commenting
- Comment CRUD operations

### 6. **Interactive Dashboard**
- Role-specific statistics and views
- Article count by status (draft/published)
- User activity overview
- Category management interface

### 7. **Clean OOP Architecture**
- **Models**: User, Article, Category, Comment
- **Enums**: Role, ArticleStatus
- **Services**: AuthService, ArticleService, UserService, CategoryService, CommentService
- **Core**: BlogCMS main controller
- Strict separation of concerns
- Type-safe implementation with PHP 8+ features

---

## Technologies Used

### Back-End
- **PHP 8.0+** — Modern PHP with strict typing, enums, named arguments
- **OOP Principles** — Encapsulation, Inheritance, Polymorphism, Abstraction
- **PSR-12** — PHP coding standards

### Architecture & Design
- **UML** — Use Case and Class Diagrams
- **PlantUML / Draw.io** — Diagram creation tools
- **MVC-inspired structure** — Models, Services, Controllers

### Development Tools
- **Git & GitHub** — Version control and collaboration
- **Composer** (optional) — PHP dependency management
- **PHPDoc** — Code documentation standards
- **Trello** — Project planning and task management

### Testing
- **Manual Testing** — Comprehensive test scenarios
- **PHPUnit** (optional) — Unit testing framework

---

## Development Workflow

**Duration**: 5 days (Intensive OOP Training Program)  
**Mode**: Individual  
**Process**:

### Day 1: Analysis & Use Cases
- Analyze client requirements and constraints
- Create Use Case Diagram with all actors
- Initialize GitHub repository
- Write initial README documentation
- **Deliverable**: Use Case Diagram + README + Trello Board

### Day 2: Architecture Design
- Design complete Class Diagram
- Define all relationships and multiplicities
- Document OOP architecture choices
- Update README with technical details
- **Deliverable**: Class Diagram + Updated README

### Day 3: Core Implementation
- Implement Model classes (User, Article, Category, Comment)
- Create Role enum with 4 permission levels
- Build AuthService with permission matrix
- Develop ArticleService with CRUD operations
- **Deliverable**: Core code + Initial tests

### Day 4: Complete System
- Implement UserService, CategoryService, CommentService
- Build BlogCMS main controller with CLI menu
- Create test scenarios for all three personas
- Add dashboard functionality
- Debug and polish code
- **Deliverable**: Complete functional code

### Day 5: Documentation & Presentation
- Write comprehensive technical documentation
- Create user guide with examples
- Develop demo.php script
- Code review and cleanup (PSR-12)
- Prepare presentation and demo
- **Deliverable**: Final submission + Presentation

---

## Installation & Usage

### Prerequisites
```bash
# Check PHP version (8.0+ required)
php -v
```

### Installation
```bash
# Clone the repository
git clone https://github.com/yourusername/blogcms-console-edition.git

# Navigate to project directory
cd blogcms-console-edition

# Run the application
php index.php
```

### Quick Start

#### Scenario 1: Author Workflow (Léa)
```bash
# 1. Login as Léa (Author)
# 2. Create new article: "PHP 8.4 New Features"
# 3. Add categories: "Technology", "PHP"
# 4. Publish the article
# 5. View dashboard (shows 1 published article)
```

#### Scenario 2: Editor Workflow (Thomas)
```bash
# 1. Login as Thomas (Editor)
# 2. List all articles (including Léa's)
# 3. Find article with missing category
# 4. Add "Programming" category
# 5. Verify article has 3 categories
```

#### Scenario 3: Administrator Workflow (Amina)
```bash
# 1. Login as Amina (Administrator)
# 2. Create new user "New Writer"
# 3. Assign "Author" role
# 4. List all users
# 5. Verify new user appears
```

### Running Tests
```bash
# Run all test scenarios
php tests/test_scenarios.php

# Run demo script
php demo.php
```

## Deployment

**GitHub Repository**: [https://github.com/yourusername/blogcms-console-edition.git](https://github.com/yourusername/blogcms-console-edition.git)

### Future Deployment Options
- **Phase 2**: RESTful API with database integration
- **Phase 3**: Web interface with frontend framework
- **Phase 4**: Docker containerization for easy deployment

---

## License
This project is for **educational purposes** under CodeCrafters Digital.  
© 2024-2025 **BlogCMS Console Edition**. All rights reserved.

---

## Acknowledgments
Special thanks to:
- **MediaPress International** — For the realistic project specifications
- **CodeCrafters Digital** — For the opportunity and guidance
- **Simplon Training Program** — For comprehensive OOP instruction
- **PHP Community** — For excellent documentation and resources

---

## Learning Outcomes

This project demonstrates mastery of:
- ✅ Object-Oriented Programming fundamentals
- ✅ UML modeling and software design
- ✅ Role-based access control systems
- ✅ PHP 8+ modern features and best practices
- ✅ Clean architecture and SOLID principles
- ✅ Professional development workflow
- ✅ Technical documentation and presentation skills

---

## Future Enhancements

### Phase 2: Database Integration
- MySQL/PostgreSQL integration
- PDO with prepared statements
- Migration system

### Phase 3: Web Interface
- RESTful API development
- React/Vue frontend
- JWT authentication

### Phase 4: Advanced Features
- Full-text search
- Article versioning
- Media upload support
- Email notifications
- RSS feed generation
- Multi-language support

---

**Manage. Organize. Publish.**  
*BlogCMS Console Edition — Professional content management from the command line.*