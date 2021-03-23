require("./bootstrap");
window.Vue = require("vue");

const files = require.context("./", true, /\.vue$/i);
files.keys().map(key =>
    Vue.component(
        key
            .split("/")
            .pop()
            .split(".")[0],
        files(key).default
    )
);

function init() {
    const app = new Vue({
        el: "#app",
        data: {
            allTypologies: [],
            flightListType: [],
            userArray: [],
            randUsers: [],
            showTypology: true,
            showUser: false
        },
        mounted: function() {
            axios.get("/getTypologies").then(response => {
                this.allTypologies = response.data;
                console.log(this.allTypologies);
            });
            this.getRandUsers();
        },
        methods: {
            getRestaurant(id) {
                axios.get("/getUserId/" + id).then(response => {
                    this.userArray = response.data;
                    this.showTypology = !this.showTypology;
                    this.showUser = !this.showUser;
                    console.log(this.userArray);
                });
            },
            getRandUsers() {
                axios.get("/getRandUsers").then(response => {
                    while (this.randUsers.length < 6) {
                        let j = Math.floor(Math.random() * (10 - 1)) + 1;

                        while (!this.randUsers.includes(response.data[j])) {
                            this.randUsers.push(response.data[j]);
                        }
                    }
                });
            }
        }
    });
}
document.addEventListener("DOMContentLoaded", init);
