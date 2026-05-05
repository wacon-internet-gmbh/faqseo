# TYPO3 Extension: faqseo
This extension adds a new content element type "FAQ" to TYPO3, allowing you to create and manage frequently asked questions with enhanced SEO features. It provides a user-friendly interface for content editors to input questions and answers, and it automatically generates structured data (JSON-LD) for improved search engine visibility.

## 2 Usage

### 2.1 Installation

#### Installation as extension from TYPO3 Extension Repository (TER)
Download and install the [extension][1] with the extension manager module.

#### 2.2 Installation with composer
`composer req wacon/faq-seo`


#### 2.3 Configure in site set
1. Add site set **FAQ SEO** to your site sets in the site configuration
2. Edit settings of FAQ SEO. If you have already Bootstrap 5 installed and active, then remove the prefilled settings in FAQ CSS and FAQ JavaScript
3. Use you own CSS and overwrite the CSS variables defined for selector: ``.faq`` to adjust the appearance to your CD, if needed.

### 3. Add single FAQ as content elements
There is a new content element: **FAQ Item**. This is a regular content element. It's useful to place isolated and single Question/Answer elements to your site.

### 4. FAQ Database
This extension also comes with a database feature. That means there exists a new record type: ``FAQ Item`` which is stored in a custom database table. Those records can be create via the [List/Records module][2] of TYPO3.

We recommend to add those records in single folders. Each folder should represent a list of FAQs. If you need more than 1 list, then create more folders.

#### 4.1 CSV Import
The ``FAQ Item`` records can also be created via csv import. Therefore is a custom backend module called **Import FAQ Items** below the Web/Content area.
You can import FAQs with a CSV file there. All FAQ items will be stored in the selected page or folder inside the page tree.

The CSV must be comma ``,`` seperated and enclosed with double quotes ``"``. The escape character is ``\``.

## 3 Todos
- nothing yet

## 4 Changelog
see [CHANGES.md](CHANGES.md)

[1]: https://extensions.typo3.org/extension/faq_seo
[2]: https://docs.typo3.org/m/typo3/tutorial-getting-started/main/en-us/Concepts/Backend/RecordsModule/Index.html#the-records-module
