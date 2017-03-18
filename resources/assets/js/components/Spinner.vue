<template>
    <div class="text-xs-center loader-container">
        <div class="loader"></div>
    </div>
</template>

<style lang="css">
    .loader {
        border: 4px solid #f5f5f5; 
        border-top: 4px solid #00d1b2; /* Light grey */
        border-radius: 50%;
        width: 32px;
        height: 32px;
        animation: spin 500ms linear infinite;
        display: inline-block;
    }
    .loader-container small {
        display: block;
        letter-spacing: 4px;
        padding-top: 10px;
        color: #939393;
    }
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>