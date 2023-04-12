<template>
    <ContentBox title="Users requesting access" v-if="requestingAccess.length">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Company</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in requestingAccess">
                    <td>{{ user.name }}</td>
                    <td>{{ user.company }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.role_name }}</td>
                    <td>
                        <BaseDropdown menu-classes="shadow">
                            <li class="dropdown-item">
                                <a href="#" @click="" class="text-default">
                                    Change Role
                                </a>
                            </li>
                            <li class="dropdown-item">
                                <a href="#" @click="" class="text-default">
                                    Grant Access
                                </a>
                            </li>
                            <li class="dropdown-item">
                                <a href="#" @click="" class="text-default">
                                    Delete Request
                                </a>
                            </li>
                        </BaseDropdown>
                    </td>
                </tr>
            </tbody>
        </table>
    </ContentBox>
    <ContentBox title="Users">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Company</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in users">
                    <td>{{ user.id }}</td>
                    <td>{{ user.name }}</td>
                    <td>{{ user.company }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.role_name }}</td>
                    <td>
                        <BaseDropdown menu-classes="shadow">
                            <li class="dropdown-item">
                                <a href="#" class="text-default" @click="">
                                    Change Role
                                </a>
                            </li>
                            <li class="dropdown-item">
                                <a href="#" class="text-default" @click="">
                                    Revoke Access
                                </a>
                            </li>
                        </BaseDropdown>
                    </td>
                </tr>
            </tbody>
        </table>
    </ContentBox>
</template>
<script setup>
import axios from 'axios';
import { ref } from 'vue';
import ContentBox from '@/components/simple/ContentBox.vue';
import BaseDropdown from '@/components/simple/BaseDropdown.vue';
import BaseButton from '@/components/simple/BaseButton.vue';

const users = ref([]);
const requestingAccess = ref([]);

const response = await axios.get('/api/users');
users.value = response.data.filter((user) => user.has_access);
requestingAccess.value = response.data.filter((user) => !user.has_access);
</script>
