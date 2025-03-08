import axios from "axios";
import { defineStore } from "pinia";

let balance = 100;

export const useBalanceStore = defineStore('balanceStore', {
    state: () => ({
        balance: balance
    })
})