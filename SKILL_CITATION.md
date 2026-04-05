# Citation Formatter Skill

## Description
The Citation Formatter skill verifies and formats citations to meet standard academic style guides.

## Supported Citation Styles
- APA (American Psychological Association)
- MLA (Modern Language Association)
- IEEE (Institute of Electrical and Electronics Engineers)
- Chicago Manual of Style

## Capabilities

### 1. In-Text Citation Verification
- Check consistency between in-text citations and reference list
- Verify author-date or number format consistency
- Identify missing or incorrect in-text citations

### 2. Reference List Formatting
- Format references according to selected style guide
- Ensure proper punctuation and ordering
- Handle various source types (books, journals, websites, etc.)

### 3. Citation Completeness Check
- Identify missing required information
- Flag incomplete citations
- Suggest corrections for missing elements

### 4. Format Conversion
- Convert between citation styles (when possible)
- Transform informal references to proper format
- Standardize citation formatting across document

### 5. Punctuation and Structure
- Fix punctuation errors in citations
- Ensure proper italics and quotation marks usage
- Verify alphabetical/numerical ordering

## Input Requirements
- Document with citations
- Target citation style (APA, MLA, IEEE, Chicago)
- Optional: reference list section

## Output
- Formatted citations in requested style
- List of citation issues found
- Corrections for incomplete or incorrect citations

## Configuration Options
- `style`: APA | MLA | IEEE | Chicago
- `version`: 6th | 7th | 8th | 9th (style-specific)
- `format`: in-text | reference-list | both
- `preserve_original`: true | false (show original vs. formatted)
