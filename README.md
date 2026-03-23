# TYPO3 Extension: faqseo
This extension adds a new content element type "FAQ" to TYPO3, allowing you to create and manage frequently asked questions with enhanced SEO features. It provides a user-friendly interface for content editors to input questions and answers, and it automatically generates structured data (JSON-LD) for improved search engine visibility.

## 2 Usage

### 2.1 Installation

#### Installation as extension from TYPO3 Extension Repository (TER)
Download and install the [extension][1] with the extension manager module.

#### 2.2 Installation with composer
`composer req wacon/faqseo`


#### 2.3 Configure in site set
1. Add site set **FAQ SEO** to your site sets in the site configuration
2. Edit settings of FAQ SEO. If you have already Bootstrap 5 installed and active, then remove the prefilled settings in FAQ CSS and FAQ JavaScript
3. Use you own CSS and overwrite the CSS variables defined in .faq to adjust the appearance to your CD, if needed.

## 3 Todos
- nothing yet

## 4 Changelog
see [CHANGES.md](CHANGES.md)

[1]: https://extensions.typo3.org/extension/faq_seo
