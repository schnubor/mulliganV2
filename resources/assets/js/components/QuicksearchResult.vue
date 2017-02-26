<template>
    <tr>
        <th>
            {{ result.set }}
        </th>
        <td>
            <a href="">{{ result.name }}</a>
        </td>
        <td>
            <template v-for="manaCost in manaCosts">
                <i class="ms ms-cost" :class="manaCost"></i>
            </template>
        </td>
    </tr>
</template>

<script>
    export default {
        props: ['result'],
        computed : {
            manaCosts() {
                const manaString = this.result.manaCost;
                const re = /(\{.*?\})/g;
                let splits = manaString.split(re);
                let manaCosts = [];

                splits = splits.filter( Boolean ); // e.g. ['{R}','{W}']

                // Build class strings from splits
                for( const split of splits ) {
                    const manaCostLetter = split.slice(1, -1).toLowerCase();
                    const classString = `ms-${manaCostLetter}`;
                    manaCosts.push( classString );
                }

                return manaCosts;
            }
        }
    }
</script>