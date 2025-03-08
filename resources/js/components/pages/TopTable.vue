<template>
    <div>
    <h1>Топ игроков</h1>
    <table>
        <thead>
            <tr>
                <th>Имя</th>
                <th>Место</th>
                <th>Баланс</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(user,i) in users" :key="i">
                <td :class="user.id == user_id ? 'count-user':''">{{user.name}}</td>
                <td>{{i + 1}}</td>
                <td class="green-text">{{user.balance}}</td>
            </tr>
        </tbody>
    </table>
    </div>
</template>

<script>
export default{
    props:{users:Array,user_id:Number}
}
</script>

<style scoped>
    h1{
        font-size: 24px;
        text-align: center;
    }
    table {
        width: 800px;
        margin-right: 20px;
        border-collapse: collapse;
        margin-top: 20px;
        margin-bottom: 20px;
    }
    
    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }
    
    th {
        background-color: #4CAF50;
        color: white;
    }
    
    td {
        background-color: #f2f2f2;
    }
    
    tr:nth-child(even) {background-color: #f9f9f9;}
    
    .green-text {
        color: #2E8B57; /* темно-зеленый цвет для текста */
    }

    .count-user{
        font-weight: bold;
        color: green;
    }
    @media (max-width: 1050px) {
        table {
            width: 600px;
        }
    }
    @media (max-width: 900px) {
        table {
            width: 500px;
        }
    }
    @media (max-width: 750px) {
        table {
            width: 400px;
        }
    }
    @media (max-width: 620px) {
        table {
            width: 300px;
        }
    }
    @media (max-width: 520px) {
        h1{
            margin-top: 30px;
        }
        table{
            margin-right: 0;
        }
    }
    @media (max-width: 400px) {
        table {
            width: 250px;
        }
    }
    @media (max-width: 300px) {
        table {
            width: 150px;
        }
    }
</style>