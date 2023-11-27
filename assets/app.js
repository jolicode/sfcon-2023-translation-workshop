import './bootstrap.js';
import {
    trans,
    SEARCH_RESULTS_HEADING,
} from './translator.js';


const observer = new MutationObserver((mutations, observer) => {
    let count = mutations.findLast((mutation) => mutation.target.id === 'search-results').target.childElementCount;
    document.querySelector('.search-results-title').innerHTML = trans(SEARCH_RESULTS_HEADING, { count: count });
});
observer.observe(document.querySelector('#search-results'), {
    subtree: true,
    attributes: true,
});
