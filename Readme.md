# TYPO3 Extension `news_category_pid_constraint`

This extensions avoid duplicate content usage if the setting *Single-view page for news from this category* of a news
category is used. 

Furthermore this extension can be used as example who to implement an event listener (TYPO3 11) or  Signal Slots (TYPO3 10).

Requirements:

- Every category got its dedicated detail page
- TYPO3 10/11
- EXT:news 9

## Usage

Install with `composer req georgringer/news-category-pid-constraint`.

## Configuration

With the following configuration a page not found error is shown instead of letting ext:news and its error handling
decide what to do:

```typo3_typoscript
plugin.tx_news.settings {
    news_category_pid_constraint.pageNotFoundError = 1
}
```