<template>
    <v-app>
        <v-container>
            <v-form>
                <v-row no-gutters>
                    <v-col>
                        <v-menu>
                            <template v-slot:activator={on}>
                                <v-text-field
                                    class="datePicker"
                                    label="Date"
                                    v-model="item.date"
                                    v-on="on"
                                    outlined
                                    prepend-icon="mdi-calendar"></v-text-field>
                            </template>
                            <v-date-picker
                                v-model="item.date"></v-date-picker>
                        </v-menu>
                    </v-col>
                    <v-col>
                        <v-menu>
                            <template v-slot:activator={on}>
                                <v-text-field
                                    class="timePicker"
                                    v-model="item.time"
                                    label="Time"
                                    v-on="on"
                                    outlined
                                    prepend-icon="mdi-clock-outline"></v-text-field>
                            </template>
                            <v-time-picker
                                v-model="item.time"></v-time-picker>
                        </v-menu>
                    </v-col>
                    <v-col>
                        <v-text-field
                            label="Meeting URL"
                            v-model="item.url"
                            solo
                            dense
                            outlined></v-text-field>
                    </v-col>
                </v-row>
                <v-row>
                    <v-text-field
                        label="Venue"
                        outlined
                        v-model="item.venue"
                        class="venuePicker"></v-text-field>
                </v-row>
                <v-row>
                    <v-text-field
                        label="Meeting Title"
                        outlined
                        v-model="item.title"
                        class="meeting"></v-text-field>
                </v-row>
                <v-row>
                    <v-textarea
                        label="Items of the Last Meeting"
                        v-model="item.last"
                        outlined
                        rows="2"></v-textarea>
                </v-row>
                <v-row>
                    <v-col>
                        <v-file-input
                            class="filePicker"
                            :value="file"
                            outlined
                            @change="fileInput"
                            label="Enter file to upload"></v-file-input>
                    </v-col>
                    <v-col>
                        <v-file-input
                            class="imagePicker"
                            :value="image"
                            outlined
                            @change="imageInput"
                            label="Enter image to replace"></v-file-input>
                    </v-col>
                </v-row>
                <v-row>
                    <v-textarea
                        label="Agenda 1"
                        v-model="item.l1"
                        outlined
                        rows="2"></v-textarea>
                </v-row>
                <v-row>
                    <v-textarea
                        label="Agenda 2"
                        v-model="item.l2"
                        outlined
                        rows="2"></v-textarea>
                </v-row>
                <v-row>
                    <v-textarea
                        label="Agenda 3"
                        v-model="item.l3"
                        outlined
                        rows="2"></v-textarea>
                </v-row>
                <v-row>
                    <v-textarea
                        label="Minutes Taken"
                        v-model="item.min"
                        outlined
                        rows="2"></v-textarea>
                </v-row>
                <v-row>
                    <v-col
                        class="d-flex"
                        cols="12"
                        sm="6">
                        <v-select
                            outlined
                            v-model="item.template"
                            :items="templates"
                            solo></v-select>
                    </v-col>
                </v-row>
                <v-row align-content="center">
                    <v-btn
                        @click="addAgendaItems()">
                        <v-icon small>mdi-android-messages</v-icon>
                        <span> Submit </span>
                    </v-btn>
                </v-row>
            </v-form>
        </v-container>
    </v-app>

</template>

<script>

import axios from 'axios'

export default {
    
    data(){
        return{
            item:{
                date: '',
                time:'',
                url:'',
                venue:'',
                title:'',
                last:'',
                l1:'',
                l2:'',
                l3:'',
                min:'',
                template:''
            },
            templates:[
                'T1', 'T2', 'T3', 'T4'
            ],
            image: null,
            file: null
        }
    },
    methods:{
        imageInput(event){
            let imageFile = event
            this.image = imageFile
            console.log(this.image)
        },
        fileInput(event){
            let inputFile = event
            this.file = inputFile
            console.log(this.file)
        },
        addAgendaItems(){
            let formData = new FormData()

            formData.append('file', this.file)
            formData.append('image', this.image)
            const json = JSON.stringify({
                item: this.item
            })
            formData.append('item', json)

            const config = {
                headers: {'content-type': 'multipart/form-data'}
            }

            console.log(this.item)
            console.log(...formData)
            
            axios.post('http://localhost/vueBlog/public/generate_doc',formData,config)
            .then(response => {
                if(response.status === 201){
                    console.log(response.status)
                    for(var i in this.item){
                        this.item[i] = ''
                    }
                }
            })
            .catch(error => {
                console.log(error)
            })
        }
    }
    
}
</script>

<style scoped>
    .datePicker{
        width: 275px;
    }
    .timePicker{
        width: 275px;
    }
    .filePicker{
        width: 300px;
    }
    .imagePicker{
        width: 300px;
    }
</style>