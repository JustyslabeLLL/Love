        document.addEventListener('DOMContentLoaded', function() {
            const marqueeContent = document.getElementById('marqueeContent');
            
            // Массив с элементами бегущей строки
            const items = [
                {text: 'nado', color: '#FF6B6B', textColor: '#FFFFFF'},
                {text: '3TM', color: '#4ECDC4', textColor: '#FFFFFF'},
                {text: 'BSc', color: '#45B7D1', textColor: '#FFFFFF'},
                {text: 'Payout User', color: '#FFA07A', textColor: '#FFFFFF'},
                {text: '# Team', color: '#98D8C8', textColor: '#333333'},
                {text: 'marilon', color: '#F06292', textColor: '#FFFFFF'},
                {text: 'Dekker', color: '#7986CB', textColor: '#FFFFFF'}
            ];
            
            // Создаем элементы бегущей строки
            function createMarqueeItems() {
                let itemsHTML = '';
                
                // Повторяем элементы несколько раз для плавности
                for (let i = 0; i < 8; i++) {
                    items.forEach(item => {
                        // Создаем изображение-заглушку с помощью Canvas API
                        const canvas = document.createElement('canvas');
                        canvas.width = 200;
                        canvas.height = 100;
                        const ctx = canvas.getContext('2d');
                        
                        // Рисуем фон
                        ctx.fillStyle = item.color;
                        ctx.fillRect(0, 0, canvas.width, canvas.height);
                        
                        // Рисуем текст
                        ctx.font = 'bold 24px Arial';
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'middle';
                        ctx.fillStyle = item.textColor;
                        ctx.fillText(item.text, canvas.width/2, canvas.height/2);
                        
                        // Преобразуем в data URL
                        const imageUrl = canvas.toDataURL('image/png');
                        
                        itemsHTML += `
                            <div class="marquee-item" data-text="${item.text}">
                                <img src="${imageUrl}" alt="${item.text}">
                            </div>
                        `;
                    });
                }
                
                marqueeContent.innerHTML = itemsHTML;
            }
            
            // Адаптация скорости под ширину экрана
            function adjustSpeed() {
                const width = window.innerWidth;
                const duration = width / 25; // Чем шире экран, тем дольше анимация
                marqueeContent.style.animationDuration = `${duration}s`;
            }
            
            createMarqueeItems();
            adjustSpeed();
            window.addEventListener('resize', adjustSpeed);
        });