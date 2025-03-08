<template>
      <div class="filters">
        <div class="categories">
        <ul class="all-categories">
            <li class="category" @click="$emit('filter','all')"><b>Все</b></li>
            <li v-for="category in categories" :key="category.id"
            class="category" @click="$emit('filter',category.id)"
            :style="activeId == category.id ?
            'text-decoration: underline 1px green;':''">{{category.title}}</li>
        </ul>
        </div>
    </div>
</template>

<script>
export default{
    props:{categories: Array, activeId: Number},
}
</script>

<style scoped>
.filters{
    border: solid 1px #568f56;
    width: 100%;
}
.all-categories{
    display: flex;
    flex-wrap: wrap;
}
.categories{
    padding: 15px;
    display: flex;
}
.category{
    cursor: pointer;
    margin-left: 10px;
    padding: 0 10px;
    border-right: 1px solid gray;
    border-left: 1px solid gray;
}
.category:hover{
    text-decoration: underline 1px green;
}
</style>