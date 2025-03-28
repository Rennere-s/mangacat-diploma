<div id="modal" class="modal" onclick="handleModalClick(event)">
            <div class="modal-content">
                <h2>Вы уверены что вы хотите выйти из аккаунта?</h2>
                <button class="confirm" onclick="window.location.replace('/php/exit.php')">Да, выйти</button>
                <button class="cancel" onclick="closeModal()">Отменить</button>
            </div>
        </div>