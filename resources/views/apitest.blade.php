<!-- resources/views/apitest.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            API 測試：Messages
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">

                <button onclick="createMessage()" class="bg-blue-500 text-white px-4 py-2 rounded">➕ 新增 Message</button>
                <button onclick="updateMessage()" class="bg-yellow-500 text-white px-4 py-2 rounded ml-2">✏️ 更新
                    Message</button>
                <button onclick="deleteMessage()" class="bg-red-500 text-white px-4 py-2 rounded ml-2">🗑️ 刪除
                    Message</button>

                <pre id="result" class="mt-4 bg-gray-100 p-4 rounded text-sm"></pre>

            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4 mt-7">
                <h1>API 測試</h1>
        
                <button id="check-auth" class="bg-red-700 text-white px-4 py-2 my-2 rounded ml-2">檢查登入狀態</button>
                <pre id="auth-output" class=""></pre>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        
        axios.defaults.baseURL = 'http://127.0.0.1:8000'; // 必要，完整 baseURL

        function showResult(message) {
            document.getElementById('result').innerText = JSON.stringify(message, null, 2);
        }

        async function createMessage() {
            try {
                // 📨 呼叫 API
                const response = await axios.post('/api/messages', {
                    content: '這是一個新的 message'
                });

                showResult(response.data);
            } catch (error) {
                showResult(error.response);
            }
        }

        function updateMessage() {
            const messageId = prompt("請輸入要更新的 message ID");
            if (!messageId) return;

            axios.put(`/api/messages/${messageId}`, {
                    content: '更新後的內容'
                })
                .then(response => {
                    showResult(response.data);
                })
                .catch(error => {
                    showResult(error.response);
                });
        }

        function deleteMessage() {
            const messageId = prompt("請輸入要刪除的 message ID");
            if (!messageId) return;

            axios.delete(`/api/messages/${messageId}`)
                .then(response => {
                    showResult({
                        message: '刪除成功',
                        data: response.data
                    });
                })
                .catch(error => {
                    showResult(error.response);
                });
        }

        document.getElementById('check-auth').addEventListener('click', async () => {
            try {
                const res = await axios.get('/api/apitest'); // 呼叫剛剛那條測試 API
                document.getElementById('auth-output').innerText = JSON.stringify(res.data, null, 2);
            } catch (err) {
                document.getElementById('auth-output').innerText = JSON.stringify(err.response?.data || err,
                    null, 2);
            }
        });
    </script>
</x-app-layout>
