<template>
    <tr>
        <th>KLD</th>
        <td>
            <i class="ms ms-creature"></i>
        </td>
        <td>
            <a href="">{{ result.name }}</a>
        </td>
        <td>
            <i class="ms ms-r ms-cost"></i>
            <i class="ms ms-w ms-cost"></i>
        </td>
    </tr>
</template>

<script>
    export default {
        props: ['result']
    }
</script>