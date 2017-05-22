<template>
    <div class="text-xs-center loader-container">
        <div class="loader"></div>
    </div>
</template>

<style lang="scss">
    @import "./../../../sass/variables";
    
    .loader {
        border: 2px solid $teal; 
        border-top: 4px solid #f5f5f5; /* Light grey */
        border-radius: 50%;
        width: 32px;
        height: 32px;
        animation: spin 500ms linear infinite;
        display: inline-block;
    }
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>