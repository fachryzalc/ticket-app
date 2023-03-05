<div class="sideBar">
    <div class="menuDiv">
        <h3 class="divTitle">
            Menu
        </h3>
        <ul class="menuLists grid">
            <li class="listItem">
                <a href="/ticket" class="menuLink flex {{ $page === 'ticket' ? 'active' : '' }}">
                    <i class="bi bi-ticket-detailed">&nbsp</i>
                    <span class="smallText">
                        Ticket
                    </span>
                </a>
            </li>
            <li class="listItem">
                <a href="/transaction" class="menuLink flex {{ $page === 'transaction' ? 'active' : '' }}">
                    <i class="bi bi-wallet2">&nbsp</i>
                    <span class="smallText">
                        Transaction
                    </span>
                </a>
            </li>
            {{-- <div class="sublistItem">
                <a href="/transaction" class="submenuLink flex {{ $page === 'transaction' ? 'active' : '' }}">
                    <span class="submenuText">
                        Pending
                    </span>
                </a>
                <a href="/transaction" class="submenuLink flex {{ $page === 'transaction' ? 'active' : '' }}">
                    <span class="submenuText">
                        Success
                    </span>
                </a>
                <a href="/transaction" class="submenuLink flex {{ $page === 'transaction' ? 'active' : '' }}">
                    <span class="submenuText">
                        Canceled
                    </span>
                </a>
            </div> --}}
        </ul>
    </div>
</div>
