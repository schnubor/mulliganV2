const Store = {
    cardlist    : [],
    error       : 'Please search for cards or set filters above.',
    maxResults  : 360,
    pagination  : {
        currentPage : 1,
        pageSize    : 12,
        totalPages  : null
    },
    decklist : {
        cardsum         : 0,
        artifacts       : [],
        lands           : [],
        creatures       : [],
        sorceries       : [],
        instants        : [],
        planeswalker    : [],
        enchantments    : [],
        basiclands      : {
            'mountains' : 0,
            'plains'    : 0,
            'forests'   : 0,
            'islands'   : 0,
            'swamps'    : 0
        }
    },
    cardModal : {}
};

export default Store;
