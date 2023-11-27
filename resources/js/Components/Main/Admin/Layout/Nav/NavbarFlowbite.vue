<template>
    <fwb-navbar right-side>
      <template #logo>
        <fwb-navbar-logo alt="Flowbite logo" image-url="/images/logo.svg" link="#">
          Flowbite
        </fwb-navbar-logo>
      </template>
      <template #default="{isShowMenu}">
        <fwb-navbar-collapse :is-show-menu="isShowMenu">
            <SidebarFlowbite />
        </fwb-navbar-collapse>
      </template>
    </fwb-navbar>
  </template>
  
  <script setup>
  import {
    FwbNavbar,
    FwbNavbarCollapse,
    FwbNavbarLink,
    FwbNavbarLogo,
  } from 'flowbite-vue'

  import SidebarFlowbite from '@/Components/Main/Admin/Layout/Nav/SidebarFlowbite.vue';

  </script>