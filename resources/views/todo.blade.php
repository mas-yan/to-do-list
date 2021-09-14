<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <title>Todo List</title>
  </head>
  <body>
      
    <div id="app">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <h4>To Do List
                                <button class="btn btn-sm btn-primary float-right" @click="addData">Tambah To Do</button>
                            </h4>
                        </div>
                        <div v-if="!data_list.length" class="alert alert-danger m-3">
                            data To Do belum ada
                        </div>
                        <ul class="list-group list-group-flush" v-for="item in data_list">
                            <li class="list-group-item">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="checkbox" @change="completeData(item.id,item.complete,item.title)" v-bind="item.id" v-model="item.complete">
                                        </div>
                                    </div>
                                    <div class="form-control pt-1">
                                        <span v-if="item.complete == 'true'"><s>@{{item.title}}</s></span>
                                        <span v-else>@{{item.title}}</span>
                                        <button class="btn btn-danger ml-1 btn-sm float-right" @click="deleteData(item.id)">Delete</button>
                                        <button class="btn btn-warning btn-sm float-right" @click="editData(item.id)">Edit</button>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" data-backdrop="static" id="modal-form">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" @click="title = '',id = '',complete = '' " data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" id="title" v-model="title" class="form-control" required placeholder="Title Todo" autofocus>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="title = '',id = '',complete = '' ">Close</button>
                <button type="button" class="btn btn-primary" @click="saveData">Save changes</button>
                </div>
            </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/vue@next"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        const app = {
            data(){
                return {
                    data_list : [],
                    title : "",
                    id: "",
                    complete: [],
                }
            },
            methods:{
                completeData: function (id,complete,title) {
                    axios.put("{{url('http://127.0.0.1:8000/api/to-do-list')}}/"+id,
                            {
                                complete : complete,
                                title: title
                            }
                        )
                            .then(response=>{
                                this.getData()
                            })
                            .catch(error=>{
                                console.log(error);
                            })
                },
                addData: function () {
                    $('#modal-form').modal('show')
                },
                getData: function () {
                    axios.get("{{url('http://127.0.0.1:8000/api/to-do-list')}}")
                        .then(response=>{
                            const data = response.data
                            this.data_list = data.data
                        })
                        .catch(error=>{
                            console.log(error);
                        })
                },
                saveData: function () {
                    if (this.id) {
                        axios.put("{{url('http://127.0.0.1:8000/api/to-do-list')}}/"+this.id,
                            {
                                title : this.title,
                                complete: this.complete
                            }
                        )
                            .then(response=>{
                                $('#modal-form').modal('hide')
                            })
                            .catch(error=>{
                                console.log(error);
                            })
                            .finally(()=>{
                                this.getData()
                                this.title = ""
                                this.complete = ""
                            })
                    }else{
                        axios.post("{{url('http://127.0.0.1:8000/api/to-do-list')}}",
                            {
                                title : this.title
                            }
                        )
                            .then(response=>{
                                $('#modal-form').modal('hide')
                                this.getData()
                                this.title = ""
                            })
                            .catch(error=>{
                                console.log(error);
                            })
                    }
                },
                editData: function (id) {
                    this.id = id
                    axios.get("{{url('http://127.0.0.1:8000/api/to-do-list')}}/"+id)
                        .then(response=>{
                            const data = response.data
                            this.title = data.data.title
                            this.complete = data.data.complete
                            console.log(this.complete);
                            $('#modal-form').modal('show')
                        })
                        .catch(error=>{
                            console.log(error);
                        })
                },
                deleteData: function (id) {
                    this.id = id
                    axios.delete("{{url('http://127.0.0.1:8000/api/to-do-list')}}/"+id)
                        .then(response=>{
                            alert('delete success')
                            this.id = ""
                            this.getData()
                        })
                        .catch(error=>{
                            console.log(error);
                        })
                },
            },
            mounted(){
                this.getData()
            },
        }
        Vue.createApp(app).mount('#app')
    </script>
  </body>
</html>