# Fract2 CMS: Core Principles and Design Philosophy

Fract2 is a modular Content Management System (CMS) built on the principles of simplicity, efficiency, and extensibility. This document outlines the core principles that guide the development and usage of Fract2, along with their distinct advantages over common alternatives.

## Table of Contents

1. [Core Principles](#core-principles)
   1. [No Frameworks - Pure Vanilla Code](#1-no-frameworks---pure-vanilla-code)
   2. [No MVC for Maximum Code Simplicity](#2-no-mvc-for-maximum-code-simplicity)
   3. [Modular and Robust Data Structure](#3-modular-and-robust-data-structure)
   4. [Clean and Separated Code](#4-clean-and-separated-code)
   5. [TWIG for Secure and Efficient Templating](#5-twig-for-secure-and-efficient-templating)
   6. [Highly Readable Code with Descriptive Names](#6-highly-readable-code-with-descriptive-names)
   7. [Efficient Use of Resources](#7-efficient-use-of-resources)
   8. [Compatibility with Linux and Unix Systems](#8-compatibility-with-linux-and-unix-systems)
2. [Potential Use Cases](#potential-use-cases)
3. [Licence](#licence)

## Core Principles

### 1. No Frameworks - Pure Vanilla Code

Fract2 avoids the use of heavy frameworks, instead relying on pure, vanilla code. This approach reduces dependencies, improves performance, and gives developers full control over the codebase.

**Advantage**: While frameworks can speed up initial development, they often come with performance overhead and force developers to work within their constraints. Fract2's vanilla approach results in faster execution, smaller codebase, and gives developers the freedom to implement exactly what they need without unnecessary bloat.

### 2. No MVC for Maximum Code Simplicity

Fract2 eschews the traditional Model-View-Controller (MVC) pattern in favour of a more direct and simpler approach. This reduces complexity and cognitive load for developers.

**Advantage**: While MVC is popular, it often introduces unnecessary complexity for simpler applications. Fract2's approach reduces the learning curve, makes the codebase more approachable, and often results in faster development times. It's particularly beneficial for small to medium-sized projects where the overhead of MVC might be overkill.

### 3. Modular and Robust Data Structure

Fract2 uses a modular data structure that allows for perfect scalability and extensibility. Each module (or "package" in Fract2 terminology) is self-contained and can be easily added or removed.

**Advantage**: Unlike monolithic systems where all functionality is tightly coupled, Fract2's modular approach allows for easy customisation and scaling. You can add or remove features without affecting the core system, making it ideal for projects that may need to grow or change over time.

### 4. Clean and Separated Code

Fract2 emphasises clean separation of HTML, CSS, JavaScript, and PHP. This separation enhances readability, maintainability, and allows for easier collaboration amongst developers with different specialties.

**Advantage**: Unlike systems that mix languages within files (e.g., PHP and HTML in the same file), Fract2's approach allows specialists to work on their respective areas without interfering with others. This leads to cleaner code, easier debugging, and more efficient teamwork.

### 5. TWIG for Secure and Efficient Templating

Fract2 utilises TWIG as its templating engine, not as a framework dependency, but as a crucial security measure for PHP templating.

**Advantage**: While Fract2 generally adheres to a frameworkless approach, the inclusion of TWIG is a strategic decision to enhance security and efficiency:

- Enhanced Security: TWIG automatically escapes output, significantly reducing the risk of XSS (Cross-Site Scripting) attacks. This built-in security feature is crucial for maintaining the integrity of web applications.

- Sandboxed Environment: TWIG provides a restricted, sandboxed environment for template rendering. This prevents potentially harmful PHP code execution in templates, a common vulnerability in systems that use raw PHP for templating.

- Clear Separation of Concerns: By using TWIG, Fract2 enforces a strict separation between PHP logic and HTML presentation. This not only improves code organisation but also reduces the risk of mixing potentially insecure PHP code with templates.

- Performance Optimisation: TWIG compiles templates to plain, optimised PHP code, ensuring fast execution without the overhead typically associated with full-fledged frameworks.

- Controlled Feature Set: Unlike more complex frameworks, TWIG provides a limited, carefully curated set of features specifically designed for templating. This aligns with Fract2's philosophy of simplicity and efficiency.

By incorporating TWIG, Fract2 addresses critical security concerns in templating without compromising its core principle of minimalism. This approach demonstrates that security and simplicity can coexist, providing developers with a safe, efficient, and easy-to-use templating solution.

### 6. Highly Readable Code with Descriptive Names

Fract2 prioritises code readability with clear, descriptive names for variables, functions, and classes. This self-documenting approach reduces the need for extensive comments and makes the code easier to understand and maintain.

**Advantage**: Many systems use abbreviated or cryptic naming conventions that can save typing but harm readability. Fract2's approach may result in slightly longer names, but it dramatically reduces the time needed to understand and maintain the code, especially for new team members or when returning to a project after a long time.

### 7. Efficient Use of Resources

Fract2 is designed to be lightweight and efficient, making the most of server resources.

**Advantage**: Many modern CMS systems require significant server resources, leading to higher hosting costs and slower performance. Fract2's efficient design allows it to run smoothly on more modest hardware, reducing costs and improving user experience through faster load times.

### 8. Compatibility with Linux and Unix Systems

Fract2 is designed to be fully compatible with Linux and Unix systems, ensuring wide server compatibility and ease of deployment.

**Advantage**: While some systems are optimised for specific environments, Fract2's compatibility approach ensures it can run efficiently on a wide range of servers. This flexibility can lead to cost savings and easier scaling, as you're not locked into specific hosting solutions.

## Potential Use Cases

Fract2's revolutionary simplicity makes it particularly well-suited for:

1. Small to Medium-sized Business Websites: Fract2's efficiency and ease of use make it ideal for businesses that need a robust online presence without the complexity of enterprise-level systems.

2. Educational Institutions: Schools and universities can benefit from Fract2's modular structure to create and manage course websites, student portals, and departmental pages.

3. Non-profit Organisations: The cost-effective nature of Fract2 and its ability to run on modest hardware make it an excellent choice for non-profits with limited IT budgets.

4. Personal Blogs and Portfolios: Fract2's simplicity allows individuals to create and maintain their online presence without needing extensive technical knowledge.

5. Prototype and MVP Development: Startups and developers can use Fract2 to quickly build and iterate on new web applications or services.

6. Content-heavy Websites: News portals, online magazines, and content aggregators can leverage Fract2's efficient resource usage to handle large volumes of content.

7. E-commerce Platforms: Small to medium-sized online stores can benefit from Fract2's modularity to add and customise e-commerce functionalities as needed.

## Licence

BSD 3-Clause Licence

Copyright (c) 2023, Vivian Burkhard Voss
All rights reserved.

Redistribution and use in source and binary forms, with or without
modification, are permitted provided that the following conditions are met:

1. Redistributions of source code must retain the above copyright notice, this
   list of conditions and the following disclaimer.

2. Redistributions in binary form must reproduce the above copyright notice,
   this list of conditions and the following disclaimer in the documentation
   and/or other materials provided with the distribution.

3. Neither the name of the copyright holder nor the names of its
   contributors may be used to endorse or promote products derived from
   this software without specific prior written permission.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE
FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY,
OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.