# plg_content_prefilltitle

Joomla content plugin that prefills the article title on new article creation using a plugin parameter fetched through `com_ajax`.

## Installation

1. Download the repository as ZIP
2. In Joomla administrator, go to **System → Install → Extensions**
3. Upload the ZIP file

## Usage

1. Enable **Content - Prefill Title**
2. Open the plugin settings
3. Set a value for **Default title**
4. Go to **Content → Articles → New**

If the title field is empty, it will be automatically filled with the configured value.

## Notes

- Runs only in administrator article form
- Applies only to new articles
- Does not overwrite an already filled title