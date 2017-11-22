<!-- filter for everything not mobile -->
<ul class="filter pt--10x flex--wrap" v-if="data.device !== 'mobile'">
    <li class="filter__item px--3x py--1x my--1x" :class="{'filter__item--active': !isFiltered}" @click="reset">all</li>
    <% loop $Filters %>
        <li class="filter__item px--3x py--1x my--1x" :class="{'filter__item--active': inArray('$name')}" @click="toggle('$name')">$name</li>
    <% end_loop %>
</ul>
<!-- /filter for everything not mobile -->

<!-- mobile filter -->
<dropdown :visible="visible" @clickOut="visible = false" :position="[ 'center', 'bottom', 'left', 'top' ]" :animation="'ani-slide-y'" class="mobile-dropdown relative mt--5x" v-else>
    <div class="font--6x py--2x center-mobile" @click="visible = true">Filter by</div>
    <div class="font--6x color--dark" slot="dropdown">
        <div class="py--2x" :class="{'font--bold': !isFiltered}" @click="reset">All</div>
        <% loop $Filters %>
        <div class="py--2x" :class="{'font--bold': inArray('$name')}" @click="toggle('$name')">$name</div>
        <% end_loop %>
    </div>
</dropdown>
<!-- /mobile filter -->