# plg_content_prefilltitle

Joomla content plugin that prefills the article title on new article creation using a plugin parameter fetched through `com_ajax`.

## Features

- Adds a plugin parameter to define a default title
- Loads only in the administrator article form
- Uses `com_ajax` to retrieve the configured value
- Prefills the title field only for new articles
- Does not overwrite an already entered title

## Installation

1. Download the repository as ZIP
2. In Joomla administrator, go to **System → Install → Extensions**
3. Upload the ZIP file

## Usage

1. Enable **Content - Prefill Title**
2. Open the plugin settings
3. Set a value for **Default title**
4. Go to **Content → Articles → New**

The title field will be automatically filled with the configured value.

## Notes

- Built using the Joomla modern plugin structure
- Intended as the Joomla GSoC 2026 test task submission