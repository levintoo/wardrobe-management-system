<template>
    <!-- New Table -->
    <div class="shadow-xs w-full overflow-hidden">
        <div class="w-full overflow-x-auto">
            <table class="whitespace-no-wrap w-full">
                <slot name="thead"></slot>
                <slot name="tbody"></slot>
            </table>
        </div>
        <slot name="pagination"></slot>
    </div>
</template>
