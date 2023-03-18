<template>
    <div>

        <div class="mb-4">
            <div class="text-gray-500 mb-3 text-uppercase">
                Your Caseflows
            </div>
            <ul class="fa-ul">
                <li>
                    <RouterLink :to="{
                        name: 'CaseFlows',
                        params: { caseType: 'probate' }
                    }" class="router-link">
                        <span class="fa-li">
                            <i class="fas fa-pen-nib me-2"></i>
                        </span>
                        Probate Desk
                    </RouterLink>
                </li>
            </ul>
        </div>
        <div class="mb-4">
            <RouterLink class="router-link text-uppercase" to="/dashboard/document-library">
                Document Library
            </RouterLink>
        </div>
        <div class="mb-4">
            <RouterLink class="router-link text-uppercase" to="/dashboard/knowledge-base">
                Knowledge Base
            </RouterLink>
        </div>
        <div class="mb-4">
            <RouterLink class="router-link text-uppercase" to="/dashboard/help">Help & Contact</RouterLink>
        </div>
    </div>
</template>

<script></script>