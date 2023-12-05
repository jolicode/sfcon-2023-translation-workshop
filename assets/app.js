import './bootstrap.js';
import {
    trans,
    SEARCH_RESULTS_HEADING,
} from './translator.js';


if (document.querySelector('#search-results')) {
    const observer = new MutationObserver((mutations) => {
        let count = mutations.findLast((mutation) => {
            return mutation.target.id === 'search-results';
        }).target.childElementCount;
        document.querySelector('.search-results-title').innerHTML = trans(SEARCH_RESULTS_HEADING, { count });
    });
    observer.observe(document.querySelector('#search-results'), {
        subtree: true,
        attributes: true,
    });
}
