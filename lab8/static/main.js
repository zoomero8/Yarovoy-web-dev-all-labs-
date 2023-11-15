// создает кнопку с номером стр.
function createPageBtn(page, classes=[]) {
    let btn = document.createElement('button');
    classes.push('btn');
    for (cls of classes) {
        btn.classList.add(cls);
    }
    btn.dataset.page = page;
    btn.innerHTML = page;
    return btn;
}

// отрисовка интерфейса пагинации
function renderPaginationElement(info) {
    let btn;
    let paginationContainer = document.querySelector('.pagination');
    paginationContainer.innerHTML = '';

    btn = createPageBtn(1, ['first-page-btn']);
    btn.innerHTML = 'Первая страница';
    if (info.current_page == 1 || info.total_count==0) {
        btn.style.visibility = 'hidden';
    }
    paginationContainer.append(btn);

    let buttonsContainer = document.createElement('div');
    buttonsContainer.classList.add('pages-btns');
    paginationContainer.append(buttonsContainer);

    let start = Math.max(info.current_page - 2, 1);
    let end = Math.min(info.current_page + 2, info.total_pages);
    for (let i = start; i <= end; i++) {
        buttonsContainer.append(createPageBtn(i, i == info.current_page ? ['active'] : []));
    }

    btn = createPageBtn(info.total_pages, ['last-page-btn']);
    btn.innerHTML = 'Последняя страница';
    if (info.current_page == info.total_pages || info.total_count==0) {
        btn.style.visibility = 'hidden';
    }
    paginationContainer.append(btn);
}

// обработчик кнопки "на страницу"
function perPageBtnHandler(event) {
    downloadData(1);
}

// установка инфы о пагинации
function setPaginationInfo(info) {
    document.querySelector('.total-count').innerHTML = info.total_count;
    let start = info.total_count > 0 ? (info.current_page - 1)*info.per_page + 1 : 0;
    document.querySelector('.current-interval-start').innerHTML = start;
    let end = Math.min(info.total_count, start + info.per_page - 1)
    document.querySelector('.current-interval-end').innerHTML = end;
}

// обработчик кнопок страницы
function pageBtnHandler(event) {
    if (event.target.dataset.page) {
        downloadData(event.target.dataset.page);
        window.scrollTo(0, 0);
    }
}

// имя автора
function createAuthorElement(record) {
    let user = record.user || {'name': {'first': '', 'last': ''}};
    let authorElement = document.createElement('div');
    authorElement.classList.add('author-name');
    authorElement.innerHTML = user.name.first + ' ' + user.name.last;
    return authorElement;
}

// кол-во лайков
function createUpvotesElement(record) {
    let upvotesElement = document.createElement('div');
    upvotesElement.classList.add('upvotes');
    upvotesElement.innerHTML = record.upvotes;
    return upvotesElement;
}

// нижний колонтитул
function createFooterElement(record) {
    let footerElement = document.createElement('div');
    footerElement.classList.add('item-footer');
    footerElement.append(createAuthorElement(record));
    footerElement.append(createUpvotesElement(record));
    return footerElement;
}

// возврат контента
function createContentElement(record) {
    let contentElement = document.createElement('div');
    contentElement.classList.add('item-content');
    contentElement.innerHTML = record.text;
    return contentElement;
}

// элемент списка, включая элементы контента и подвала.
function createListItemElement(record) {
    let itemElement = document.createElement('div');
    itemElement.classList.add('facts-list-item');
    itemElement.append(createContentElement(record));
    itemElement.append(createFooterElement(record));
    return itemElement;
}

// отчистка списка фактов и добавление новых
function renderRecords(records) {
    let factsList = document.querySelector('.facts-list');
    factsList.innerHTML = '';
    for (let i = 0; i < records.length; i++) {
        factsList.append(createListItemElement(records[i]));
    }
}

// загрузка данных с сервера
function downloadData(page=1) {
    let searchField = document.querySelector('.search-field').value;
    let factsList = document.querySelector('.facts-list');
    let url = new URL(factsList.dataset.url);
    let perPage = document.querySelector('.per-page-btn').value;
    url.searchParams.append('page', page);
    url.searchParams.append('per-page', perPage);
    url.searchParams.append('q', searchField);
    let xhr = new XMLHttpRequest();
    xhr.open('GET', url);
    xhr.responseType = 'json';
    xhr.onload = function () {
        renderRecords(this.response.records);
        setPaginationInfo(this.response['_pagination']);
        renderPaginationElement(this.response['_pagination']);
    }
    xhr.send();
}

// отчистка выпадающего списка
function clearAutocomplete() {
    let autocompleteDropdown = document.querySelector('.autocomplete-dropdown');
    autocompleteDropdown.innerHTML = '';
    autocompleteDropdown.style.display = 'none';
}

//  заполняет и отображает выпадающий список автозаполнения с предоставленными результатами поиска.
function displayAutocomplete(results) {
    let autocompleteDropdown = document.querySelector('.autocomplete-dropdown');

    for (let i = 0; i < results.length; i++) {
        let option = document.createElement('div');
        option.classList.add('autocomplete-option');
        option.textContent = results[i];
        option.addEventListener('click', function () {
            document.querySelector('.search-field').value = results[i];
            clearAutocomplete();
            downloadData();
        });
        autocompleteDropdown.appendChild(option);
    }

    autocompleteDropdown.style.display = 'block';
}

// отправления xmlhttprequest для получения подсказок автозаполнения
function autocompleteRequest() {
    let searchField = document.querySelector('.search-field').value;

    let autocompleteUrl = 'http://cat-facts-api.std-900.ist.mospolytech.ru/autocomplete?q=' + searchField;

    let xhr = new XMLHttpRequest();
    xhr.open('GET', autocompleteUrl);
    
    xhr.responseType = 'json';

    xhr.onload = function () {
        if (this.response) {
            clearAutocomplete();

            displayAutocomplete(this.response);
        }
    };
    xhr.send();
}

// отчистка выпадающего списка
function SearchdownloadData() {
    downloadData();

    clearAutocomplete();
}

// запуск функции downloadData при загрузке страницы и настройка слушаетелей событий
window.onload = function () {
    downloadData();
    document.querySelector('.pagination').onclick = pageBtnHandler;
    document.querySelector('.per-page-btn').onchange = perPageBtnHandler;
    document.querySelector('.search-btn').onclick = SearchdownloadData;
    document.querySelector('.search-field').oninput = autocompleteRequest;
}