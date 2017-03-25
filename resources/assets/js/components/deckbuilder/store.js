const Store = {
    cardlist    : [],
    error       : 'Please search for cards or set filters above.',
    pagination  : {
        currentPage : 1,
        pageSize    : 12,
        totalPages  : null
    },
    decklist : {
        artifacts       : [],
        lands           : [],
        creatures       : [],
        sorceries       : [],
        instants        : [],
        planeswalker    : [],
        enchantments    : []
    }
};

export default Store;
