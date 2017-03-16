<template>
    <section class="hero is-light">
        <div class="hero-body">
            <div class="container">
                <div class="columns">
                    <div class="column is-3">
                        <p class="control">
                            <span class="select is-fullwidth">
                                <select>
                                    <option>Select Set</option>
                                    <option>Aether Revolt</option>
                                </select>
                            </span>
                        </p>
                    </div>
                    <div class="column is-4">
                        <p class="control">
                            <input class="input" type="email" placeholder="Card name">
                        </p>
                    </div>
                    <div class="column">
                        <div class="mana-switch">
                            <i class="ms ms-r ms-cost ms-shadow ms-2x ms-fw"></i>
                        </div>
                        <div class="mana-switch active">
                            <i class="ms ms-w ms-cost ms-shadow ms-2x ms-fw"></i>
                        </div>
                        <div class="mana-switch active">
                            <i class="ms ms-g ms-cost ms-shadow ms-2x ms-fw"></i>
                        </div>
                        <div class="mana-switch">
                            <i class="ms ms-b ms-cost ms-shadow ms-2x ms-fw"></i>
                        </div>
                        <div class="mana-switch">
                            <i class="ms ms-u ms-cost ms-shadow ms-2x ms-fw"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {}
</script>

<style lang="scss">
    .mana-switch {
        display: inline-block;
        padding: 0 5px;
        cursor: pointer;
        opacity: .5;
        transition: .2s all;

        &:hover, &.active{
            opacity: 1
        }
    }
</style>