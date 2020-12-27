document.querySelectorAll(".captions").forEach(function(el){
  let renderedText = el.innerHTML.replace(/#(\w+)/g, "<a href='/search?query=%23$1'>#$1</a>");
  el.innerHTML = renderedText
})

                        function like(id){
                            const el = document.getElementById('post-btn-' + id)
                            fetch('/like/' + id)
                            .then(Response => Response.json())
                            .then(data => {
                                el.innerText = (data.status == 'LIKE') ? 'unlike' : 'like'
                            });
                        }