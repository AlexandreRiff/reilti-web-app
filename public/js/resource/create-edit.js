// * INPUT IMAGE
const inputAddImage = document.querySelector('[data-js="inputAddImage"]');
const imgPreview = document.querySelector('[data-js="imgPreview"]');
const boxViewImageInner = document.querySelector(
    '[data-js="boxViewImageInner"]'
);
const boxImageDragAndDrop = document.querySelector(
    '[data-js="boxImageDragAndDrop"]'
);

const uploadImage = () => {
    const image = inputAddImage.files[0];
    const imageLink = URL.createObjectURL(image);

    imgPreview.src = imageLink;
    imgPreview.classList.add("d-block");
    boxViewImageInner.classList.add("d-none");
};

const dropImage = (event) => {
    event.preventDefault();
    inputAddImage.files = event.dataTransfer.files;
    uploadImage();
};

inputAddImage.addEventListener("change", uploadImage);
boxImageDragAndDrop.addEventListener("dragover", (event) => {
    event.preventDefault();
});
boxImageDragAndDrop.addEventListener("drop", dropImage);
// * END INPUT IMAGE

// * INPUT FILE
const inputFile = document.querySelector('[data-js="inputFile"]');
const inputFileInitial = document.querySelector('[data-js="inputFileInitial"]');

const transformarArrayParaObjeto = (paths) => {
    const objeto = {};

    paths.forEach((caminho) => {
        const partes = caminho.split("/");
        let subObjeto = objeto;

        partes.forEach((parte, indice) => {
            if (!subObjeto[parte]) {
                subObjeto[parte] = {};
            }

            subObjeto = subObjeto[parte];
        });
    });

    return objeto;
};

let output = [];
let id = 0;
const transformarObjetoParaTree = (obj, parentId = "#") => {
    for (let key in obj) {
        let icon = "bi bi-folder-fill fs-5 me-1";
        id++;
        if (Object.keys(obj[key]).length > 0) {
            output.push({
                id: id.toString(),
                parent: parentId,
                text: key,
                icon: icon,
                state: {
                    opened: true,
                    disabled: true,
                },
            });
            transformarObjetoParaTree(obj[key], id.toString());
        } else {
            if (key.includes(".html")) {
                icon = "bi bi-filetype-html fs-5 me-1";
            }

            output.push({
                id: id.toString(),
                parent: parentId,
                text: key,
                icon: icon,
            });
        }
    }
};

const listFilesZip = (event) => {
    const file = event.currentTarget.files[0];
    const reader = new FileReader();

    if (
        file.type == "application/x-zip-compressed" ||
        file.type == "application/zip"
    ) {
        reader.readAsArrayBuffer(file);

        reader.onload = (event) => {
            const result = event.target.result;

            JSZip.loadAsync(result)
                .then((zip) => {
                    const files = zip.files;

                    const filenameFilter = Object.keys(files).filter(
                        (filename) => {
                            return filename.includes(".html");
                        }
                    );

                    const arrayTransformado =
                        transformarArrayParaObjeto(filenameFilter);

                    transformarObjetoParaTree(arrayTransformado);

                    $('[data-js="directoryTree"').jstree("destroy").empty();
                    $('[data-js="directoryTree"').jstree({
                        core: {
                            data: output,
                        },
                    });
                    $('[data-js="directoryTree"').on(
                        "changed.jstree",
                        function (event, data) {
                            let filename = "/";

                            const parents = data.node.parents.sort();

                            parents.forEach((parent) => {
                                if (parent != "#") {
                                    filename +=
                                        data.instance.get_node(parent).text +
                                        "/";
                                }
                            });

                            filename += data.node.text;
                            inputFileInitial.value = filename;
                        }
                    );

                    if (isMediaHtml()) {
                        showDirectoryTree();
                    }

                    output = [];
                })
                .catch((error) => {
                    console.error(
                        "Failed to open",
                        file.name,
                        " as ZIP file:",
                        error
                    );
                });
        };

        reader.onerror = (error) => {
            console.error("Failed to read file", error);
        };
    }
};

inputFile.addEventListener("change", listFilesZip);

// * END INPUT FILE

const inputMedia = document.querySelector('[data-js="inputMedia"]');
const sectionDirectoryTree = document.querySelector(
    '[data-js="sectionDirectoryTree"]'
);

inputMedia.addEventListener("change", () => {
    if (isMediaHtml()) {
        showDirectoryTree();
    } else {
        hideDirectoryTree();
    }
});

const isMediaHtml = () => {
    const value = inputMedia.value;
    const options = inputMedia.options;

    const [selectedOption] = Array.from(options).filter((option) => {
        return option.value == value;
    });

    if (selectedOption.innerText.trim() == "HTML") {
        return true;
    }

    return false;
};

const showDirectoryTree = () => {
    sectionDirectoryTree.classList.add("d-block");
    sectionDirectoryTree.classList.remove("d-none");
};

const hideDirectoryTree = () => {
    sectionDirectoryTree.classList.add("d-none");
    sectionDirectoryTree.classList.remove("d-block");
};
