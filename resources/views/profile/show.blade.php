@extends('layouts.app')

@section('title', '個人頁面')

@section('content')
    <div class="profile-container">
        <div class="profile-header">
            <img src="{{ Auth::user()->profile_photo_url }}" alt="Avatar" class="profile-avatar">
            <div class="profile-info">
                <h2 class="profile-name">{{ Auth::user()->name }}</h2>
                <p class="profile-bio">探索中的 Laravel 學習者 🌱</p>
                <div class="profile-stats">
                    <span>{{ $messages->count() }} Threads</span>・<span>120 Followers</span>・<span>80 Following</span>
                </div>
            </div>
        </div>

        <div class="threads-container">
            @foreach ($messages as $message)
                <div class="thread-card">
                    <div class="flex flex-row justify-between">
                        <div class="thread-header">
                            <img src="{{ Auth::user()->profile_photo_url }}" alt="avatar" class="avatar">
                            <div>
                                <div class="author">{{ Auth::user()->name }}</div>
                                <div class="timestamp">{{ $message->created_at->diffForHumans() }}</div>
                            </div>
                        </div>
                        <div class="dropdown-wrapper relative flex justify-center items-center">
                            <div onclick="toggleDropdown({{ $message->id }})"
                                class="p-1 hover:bg-gray-200 rounded-full duration-300 transition-all cursor-pointer">
                                <svg class="w-[25px] h-[25px]" aria-label="更多" role="img" viewBox="0 0 24 24"
                                    class="x1lliihq x135i0dr x2lah0s x1f5funs x1n2onr6 x1bl4301 x1gaogpn"
                                    style="--fill: currentColor; --height: 20px; --width: 20px;">
                                    <title>更多</title>
                                    <circle cx="12" cy="12" r="1.5"></circle>
                                    <circle cx="6" cy="12" r="1.5"></circle>
                                    <circle cx="18" cy="12" r="1.5"></circle>
                                </svg>
                            </div>
                            <div id="dropdown-{{ $message->id }}"
                                class="hidden absolute top-8 right-2 md:left-2 mt-2 w-32 bg-white rounded-md shadow-lg z-0 transition-all duration-200 ease-in-out opacity-0 scale-95">
                                <button onclick="openEditModal({{ $message->id }}, '{{ addslashes($message->content) }}')"
                                    class="block w-full px-4 py-2 text-left hover:bg-gray-100">編輯</button>
                                <button onclick="openDeleteModal({{ $message->id }})"
                                    class="block w-full px-4 py-2 text-left text-red-600 hover:bg-gray-100">刪除</button>
                            </div>
                        </div>
                    </div>
                    <div class="thread-content">
                        {{ $message->content }}
                    </div>
                    <div class="thread-actions">
                        <div class="thread-buttons">
                            <button>❤️</button>
                            <span>{{ $message['likes'] ?? 0 }}</span>
                        </div>
                        <div class="thread-buttons">
                            <button>💬</button>
                            <span>{{ $message['comments'] ?? 0 }}</span>
                        </div>
                        <div>
                            <button>🔁</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div id="edit-modal" class="hidden absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center z-20" onclick="if(event.target === this) closeEditModal()"> {{-- click except inner content --}}
            <div class="bg-white rounded-lg w-[80%] max-w-96 p-4">
                <h3 class="text-lg font-bold my-2 text-center">編輯貼文</h3>
                <form id="edit-form">
                    <div class="thread-content-area">
                        <textarea id="edit-content" name="content" rows="5" class="w-full border rounded p-2 mb-4"></textarea>
                    </div>
                    <div class="flex justify-center gap-8">
                        <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-gray-200 rounded hover:scale-110 duration-200 transition-all">取消</button>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:scale-110 duration-200 transition-all">儲存</button>
                    </div>
                </form>
            </div>
        </div>

        <div id="delete-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[20]" onclick="if(event.target === this) closeDeleteModal()">
            <div class="bg-white rounded-lg w-[80%] max-w-96 p-4 flex flex-col justify-center items-center gap-3">
                <h3 class="text-lg font-bold my-3">刪除留言？</h3>
                <p class=" text-center mb-4">刪除這則留言後，即無法恢復顯示。</p>
                <div class="flex justify-between gap-4">
                    <button type="button" onclick="closeDeleteModal()" class="px-4 py-2 bg-gray-200 rounded hover:scale-110 duration-200 transition-all">取消</button>
                    <button id="delete-form" type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:scale-110 duration-200 transition-all">刪除</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function toggleDropdown(id) {

            const dropdown = document.getElementById(`dropdown-${id}`);
            if (dropdown.classList.contains('hidden')) {
                dropdown.classList.remove('hidden');
                void dropdown.offsetWidth;
                dropdown.classList.remove('opacity-0', 'scale-95');
                dropdown.classList.add('opacity-100', 'scale-100');
            } else {
                dropdown.classList.remove('opacity-100', 'scale-100');
                dropdown.classList.add('opacity-0', 'scale-95');
                setTimeout(() => {
                    dropdown.classList.add('hidden');
                }, 200);
            }
        }

        function openEditModal(id, content) {
            document.getElementById("edit-content").value = content;
            document.getElementById("edit-form").action = `/api/messages/${id}`;
            document.getElementById("edit-modal").classList.remove("hidden");
            closeAllDropdowns();
        }

        function closeEditModal() {
            document.getElementById("edit-modal").classList.add("hidden");
        }

        function openDeleteModal(id) {
            document.getElementById("delete-form").action = `/api/messages/${id}`;
            document.getElementById("delete-modal").classList.remove("hidden");
            closeAllDropdowns();
        }

        function closeDeleteModal() {
            document.getElementById("delete-modal").classList.add("hidden");
        }

        function closeAllDropdowns() {
            document
                .querySelectorAll('[id^="dropdown-"]')
                .forEach((el) => {
                    el.classList.remove("opacity-100", "scale-100");
                    el.classList.add("opacity-0", "scale-95");
                    setTimeout(() => {
                        el.classList.add("hidden");
                    }, 200);
                });
        }

        document.addEventListener("click", function(event) {
            if (!event.target.closest(".dropdown-wrapper")) {
                closeAllDropdowns();
            }
        });
        document.getElementById("edit-form").addEventListener("submit", async function(e) {
            e.preventDefault();

            const content = document.getElementById("edit-content").value;
            const url = this.action;

            try {
                const response = await axios.put(url, {
                    content: content
                });

                if (response.status === 200) {
                    alert("更新成功！");
                    location.reload();
                }

            } catch (err) {
                alert("更新失敗！");
                console.error(err.response.data);
            }
        });

        document.getElementById("delete-form").addEventListener("click", async function(e) {
            e.preventDefault();

            const url = this.action;
            console.log(url)

            try {
                const response = await axios.delete(url);

                if (response.status === 204) {
                    alert("刪除成功！");
                    location.reload();
                }

            } catch (err) {
                alert("刪除失敗！");
                console.error(err.response.data);
            }
        });
    </script>
@endsection
