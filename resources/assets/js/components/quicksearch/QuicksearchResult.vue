<template>
    <tr>
        <th>
            {{ result.set }}
        </th>
        <td>
            <a :href="'/cards/' + cardTitle + '-' + result.multiverseid">{{ result.name }}</a>
        </td>
        <td>
            <template v-for="(manaCost, index) in manaCosts">
                <i class="ms ms-cost" :class="manaCost" :key="manaCost + '-' + index"></i>
            </template>
        </td>
    </tr>
</template>

<script>
    import slug from 'slug';

    export default {
        props     : [ 'result' ],
        computed : {
            cardTitle() {
                return slug( this.result.name );
            },
            manaCosts() {
                const manaString = this.result.manaCost;
                const re = /(\{.*?\})/g;
                let splits = manaString.split( re );
                const manaCosts = [];

                splits = splits.filter( Boolean ); // e.g. ['{R}','{W}']

                // Build class strings from splits
                for ( const split of splits ) {
                    let manaCostLetter = split.slice( 1, -1 ).toLowerCase();
                    let splitClass = '';

                    // create custom class for split mana, e.g. R/W
                    if( manaCostLetter.indexOf('/') > -1) {
                        manaCostLetter = manaCostLetter.replace(/\//g, '');
                        splitClass = 'ms-split';
                    }

                    const classString = `${splitClass} ms-${manaCostLetter}`;
                    manaCosts.push( classString );
                }

                return manaCosts;
            }
        }
    };
</script>
