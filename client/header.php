
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?></title>
    <link rel="shortcut icon" href="img/favicon.png">
    <link rel="stylesheet" href="css/font-awesome/css/all.min.css">
<!--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="css/style.css" >
    <link rel="stylesheet" href="css/style-sounding.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <script src="js/main.js" defer></script>
    <script src="js/sounding.js" defer></script>
</head>
<body>
<div class="main-container">
    <div class="header" id="ert">
        <div class="menu">
            <div class="wheel">
                <svg width="62" height="62" viewBox="0 0 62 62" fill="none">
                    <path d="M29.9892 1.00051H30.0312C30.2112 1.05928 30.372 1.1658 30.4966 1.30879C30.6212 1.45179 30.7049 1.62592 30.7389 1.81275C30.9668 2.96794 30.9788 3.96068 32.3581 4.1833C32.7944 4.29186 33.2527 4.27096 33.6774 4.12313C35.0807 3.17852 33.5395 1.07271 35.9923 1.36752C36.2148 1.39582 36.4225 1.49447 36.5853 1.64917C36.7481 1.80387 36.8576 2.00657 36.8979 2.2279C37.0238 2.82956 37.0238 3.65985 37.1617 4.27957C37.2094 4.47028 37.3085 4.64415 37.4481 4.78212C37.5877 4.92008 37.7625 5.01682 37.9533 5.06173C39.7525 5.49492 39.9204 4.8331 40.676 3.4974C40.7665 3.33025 40.8998 3.1903 41.0621 3.09196C41.2245 2.99362 41.41 2.94043 41.5996 2.93786C41.8944 2.91316 42.1898 2.97871 42.4467 3.12587C42.7037 3.27302 42.9101 3.49487 43.0389 3.76214C43.3087 4.46608 42.8649 5.24824 42.745 6.0304C42.7151 6.21096 42.7314 6.39617 42.7922 6.56872C42.853 6.74127 42.9565 6.89555 43.0928 7.01713C44.856 8.5995 45.3297 6.88476 46.5891 6.00634C46.7154 5.91418 46.861 5.85218 47.0149 5.82507C47.1687 5.79796 47.3266 5.80645 47.4767 5.84991C47.8507 5.9652 48.177 6.19966 48.4062 6.51775C48.5164 6.66948 48.5863 6.84682 48.6094 7.03311C48.6325 7.2194 48.608 7.40852 48.5382 7.58269C48.2253 8.13709 47.9739 8.72421 47.7885 9.33353C47.7286 9.63436 49.3298 11.1385 49.5877 11.0784C50.5412 10.8798 50.847 10.1277 51.7166 9.87503C51.8488 9.83688 51.9875 9.82681 52.1238 9.84546C52.2601 9.86411 52.391 9.91106 52.5082 9.98333C52.8585 10.1879 53.134 10.5001 53.2938 10.8738C53.3469 11.0226 53.3643 11.1819 53.3445 11.3387C53.3247 11.4955 53.2683 11.6454 53.1799 11.7763C52.4063 12.9796 51.2728 13.3587 52.6222 15.0373C52.862 15.3261 53.1019 15.7352 53.7616 15.5788C54.4213 15.4224 54.8411 15.0854 55.4408 14.8748C55.6105 14.8164 55.7924 14.8028 55.9689 14.8355C56.1454 14.8682 56.3105 14.946 56.4483 15.0614C56.7306 15.2702 56.9404 15.5627 57.048 15.8977C57.1078 16.0903 57.1132 16.2958 57.0634 16.4913C57.0136 16.6867 56.9107 16.8645 56.7661 17.0047C56.2084 17.5342 55.3988 17.8591 55.1589 18.6653C55.099 18.8819 55.6507 20.4703 56.1185 20.6929C56.7182 20.9757 57.6057 20.6388 58.4093 20.5545C58.6257 20.5327 58.8435 20.5789 59.0326 20.6867C59.2217 20.7945 59.3727 20.9586 59.4648 21.1562C59.5769 21.4005 59.642 21.6638 59.6567 21.9323C59.6587 22.1428 59.5982 22.349 59.4828 22.5248C59.3674 22.7005 59.2025 22.8378 59.009 22.9191C57.9655 23.3763 56.952 23.8516 57.3179 25.3257C57.4558 25.9274 57.4318 26.1921 57.9176 26.4087C58.7272 26.8178 60.3164 26.2162 60.7362 27.0104C60.9536 27.3489 61.041 27.7552 60.9821 28.1535C60.9738 28.3285 60.9216 28.4985 60.8304 28.6478C60.7392 28.7972 60.6119 28.921 60.4603 29.0079C59.8562 29.2541 59.2349 29.4552 58.6012 29.6096C58.4265 29.6742 58.2712 29.7829 58.1505 29.9251C58.0297 30.0674 57.9474 30.2384 57.9116 30.4218C57.3119 33.5083 60.1425 31.9019 60.9101 33.4301C61.096 33.9776 60.9821 34.9884 60.4903 35.2351C60.1125 35.5419 59.117 35.4998 58.3733 35.5299C58.1805 35.5376 57.9933 35.5976 57.8317 35.7036C57.6701 35.8095 57.5402 35.9574 57.4558 36.1316C57.2732 36.525 57.183 36.9552 57.1919 37.389C57.1975 37.5931 57.2608 37.7914 57.3744 37.9608C57.488 38.1302 57.6473 38.2636 57.8336 38.3457C58.4693 38.6285 59.2849 38.9955 59.5308 39.4287C60.0225 39.9582 59.4468 41.2337 58.991 41.4142C58.3913 41.7331 57.4378 41.4142 56.6402 41.2938C56.4551 41.2727 56.2677 41.3011 56.0971 41.3761C55.9264 41.4511 55.7786 41.5701 55.6687 41.721C55.4643 41.9357 55.3057 42.19 55.2026 42.4683C55.0995 42.7465 55.054 43.043 55.069 43.3395C55.3208 44.4285 57.7377 44.7053 56.9341 46.2275C56.825 46.4622 56.6814 46.6792 56.5083 46.8713C56.3673 47.0122 56.189 47.1098 55.9946 47.1524C55.8001 47.195 55.5976 47.181 55.4108 47.1119C54.8154 46.8019 54.1764 46.5848 53.5157 46.4681C53.3542 46.4627 53.1934 46.4934 53.0451 46.5579C52.8968 46.6224 52.7646 46.7192 52.6581 46.8412C52.3172 47.1565 52.0702 47.5606 51.9445 48.0084C51.9155 48.1525 51.9176 48.3012 51.9507 48.4444C51.9838 48.5876 52.0471 48.7221 52.1364 48.8387C52.6005 49.3001 52.9891 49.8321 53.2878 50.415C53.3353 50.5483 53.3539 50.6902 53.3425 50.8313C53.3312 50.9724 53.29 51.1094 53.2219 51.2333C53.0376 51.6474 52.6999 51.9732 52.2803 52.1418C52.1331 52.1864 51.9776 52.1966 51.8258 52.1715C51.6741 52.1465 51.53 52.0869 51.4048 51.9974C50.4212 51.3296 49.7556 50.4451 48.4902 51.4559C48.1903 51.6966 47.8905 51.7688 47.7705 52.1779C47.4707 52.9119 48.0704 53.6881 48.4362 54.4101C48.6281 54.8012 47.1169 56.2752 46.847 56.179C45.8995 55.842 45.7615 54.7109 44.76 54.4101C44.5286 54.3494 44.2836 54.3685 44.0644 54.4642C43.5366 54.6929 42.9189 54.9756 42.733 55.4871C42.4631 56.185 42.9009 56.9671 43.0209 57.7433C43.0495 57.9234 43.0321 58.1079 42.9702 58.2795C42.9083 58.451 42.804 58.604 42.667 58.724C40.676 60.4267 40.5801 57.268 39.3147 56.7506C38.761 56.628 38.1817 56.7227 37.6955 57.0153C37.5291 57.095 37.3863 57.2168 37.2812 57.3688C37.176 57.5207 37.1121 57.6974 37.0958 57.8817C37.0478 58.4232 37.0658 59.085 37.0238 59.6445C37.0115 59.8161 36.9576 59.982 36.8666 60.1278C36.7757 60.2736 36.6505 60.3948 36.5021 60.4809C33.6115 62.1354 34.9548 56.3294 31.7044 57.8817C31.5556 57.949 31.4242 58.0496 31.3202 58.1758C31.2163 58.302 31.1425 58.4504 31.1047 58.6097C30.9933 59.189 30.8492 59.7615 30.6729 60.3244C30.6137 60.4967 30.5086 60.6494 30.3691 60.7661C30.2296 60.8827 30.0609 60.9589 29.8813 60.9863C29.7059 61.0046 29.529 61.0046 29.3536 60.9863C29.1094 60.9815 28.874 60.8947 28.6848 60.7398C28.4956 60.5849 28.3637 60.3709 28.3101 60.1319C28.1122 59.2113 28.0702 57.9298 27.4405 57.623C24.6399 56.203 25.2456 59.3016 23.9622 59.9694C23.7228 60.0737 23.4592 60.1093 23.2008 60.0721C22.9425 60.0349 22.6995 59.9265 22.4989 59.7589C22.3484 59.6431 22.2301 59.4904 22.1555 59.3155C22.0809 59.1405 22.0526 58.9493 22.0731 58.7601C22.211 57.28 22.6009 56.546 21.1436 55.9503C21.0536 55.9142 20.9517 55.8601 20.8437 55.8059C20.6301 55.7046 20.3892 55.6768 20.1582 55.7268C19.9273 55.7769 19.7192 55.902 19.5663 56.0827L18.4209 57.4364C18.3109 57.5673 18.1713 57.6699 18.0138 57.7358C17.8563 57.8018 17.6855 57.8291 17.5153 57.8155C15.4104 57.6049 16.6158 55.8481 16.7837 54.398C16.8019 54.2176 16.7747 54.0354 16.7045 53.8683C16.6343 53.7011 16.5234 53.5544 16.3819 53.4414C16.0726 53.1511 15.6951 52.9441 15.2844 52.8397C15.1385 52.8101 14.9879 52.8125 14.843 52.8467C14.698 52.881 14.5622 52.9464 14.4449 53.0383L13.1075 54.0431C12.9141 54.1906 12.6765 54.268 12.4336 54.2626C12.1907 54.2571 11.9568 54.1691 11.7702 54.013L11.6622 53.9468C9.86309 52.5088 12.5198 51.7628 12.2019 50.397C12.11 50.0704 11.9503 49.767 11.7332 49.5068C11.5162 49.2465 11.2467 49.0352 10.9426 48.8868C9.74315 48.5439 9.04749 50.0901 8.004 49.8495C7.73332 49.7953 7.48249 49.6681 7.27854 49.4815C7.07459 49.2949 6.92524 49.056 6.84657 48.7906C6.79144 48.6306 6.77359 48.4602 6.79438 48.2922C6.81517 48.1243 6.87406 47.9634 6.96651 47.8219C7.3053 47.3542 7.69335 46.9245 8.12394 46.5403C8.24733 46.4242 8.34073 46.2798 8.3961 46.1194C8.45147 45.9591 8.46715 45.7876 8.44179 45.6198C8.39488 45.3133 8.28679 45.0194 8.12397 44.7557C7.96115 44.4921 7.74697 44.2642 7.49425 44.0856C7.39815 44.0309 7.29212 43.9961 7.1824 43.9833C6.27685 43.869 5.43726 44.6692 4.64565 44.4947C4.33819 44.4001 4.06938 44.2085 3.87921 43.9483C3.68903 43.6881 3.58766 43.3733 3.59016 43.0507C3.58448 42.8967 3.61394 42.7435 3.67631 42.6028C3.73867 42.462 3.83228 42.3374 3.94999 42.2384C4.49572 41.7692 5.21537 41.5104 5.66515 40.9389C5.75644 40.8119 5.81834 40.666 5.84635 40.512C5.87436 40.3579 5.86777 40.1996 5.82707 40.0484C5.74772 39.6581 5.59508 39.2865 5.37729 38.9534C5.27021 38.7958 5.12315 38.6698 4.95131 38.5884C4.77946 38.507 4.58906 38.473 4.39977 38.4901C3.59616 38.5563 2.60065 38.6766 2.23483 38.3938C1.96828 38.1872 1.77291 37.902 1.67611 37.5783C1.57931 37.2546 1.58595 36.9086 1.69509 36.5888C2.16286 35.5901 3.94999 35.921 4.39377 34.9042C5.10742 32.3892 3.27832 32.6419 1.86301 32.287C1.64511 32.2326 1.44877 32.1132 1.29993 31.9446C1.1511 31.7759 1.05677 31.5659 1.02942 31.3423C0.990195 31.0972 0.990195 30.8474 1.02942 30.6023C1.07528 30.3939 1.18285 30.2042 1.33802 30.0582C1.4932 29.9122 1.68873 29.8166 1.89899 29.784C3.27232 29.5554 4.08192 29.784 4.36378 27.979C4.46746 27.5963 4.42467 27.1886 4.24384 26.8359C3.86003 26.3546 2.99645 26.1861 2.31279 25.8973C2.08335 25.8021 1.89366 25.6304 1.77568 25.4112C1.6577 25.192 1.61865 24.9387 1.6651 24.694C2.17486 22.1911 5.22736 24.9888 5.82707 22.0587C5.86438 21.87 5.85007 21.6748 5.78566 21.4936C5.72125 21.3125 5.60914 21.1522 5.46125 21.0298C4.83156 20.5004 3.96798 20.1635 3.62614 19.4595C3.54469 19.1663 3.55382 18.8552 3.65232 18.5673C3.75083 18.2794 3.93409 18.0283 4.17787 17.8471C4.31092 17.7296 4.4713 17.6476 4.64424 17.6087C4.81717 17.5698 4.99709 17.5752 5.16739 17.6244C6.54672 18.0035 7.22438 18.5811 8.12394 17.0829C8.30386 16.7821 8.65169 16.4271 8.4238 15.8796C8.03998 15.0914 7.10444 14.8026 6.82258 13.9242C6.78579 13.7861 6.77692 13.6421 6.79649 13.5005C6.81606 13.359 6.86367 13.2228 6.93652 13.0999C8.04598 11.1445 8.97553 12.9916 10.4508 13.1842C10.7746 13.2263 12.2499 11.3792 12.106 11.0723C11.8241 10.4406 11.3204 10.0254 11.0985 9.36963C11.0516 9.21519 11.0419 9.05181 11.07 8.89286C11.0982 8.73391 11.1634 8.5839 11.2604 8.4551C11.5902 7.99784 12.136 7.52854 12.6217 7.69701C13.6832 7.91361 13.8212 8.97253 14.9126 9.21921C15.1527 9.22851 15.3925 9.19385 15.6203 9.11693C15.6203 9.11693 16.5798 8.56942 16.7657 8.18436C17.2575 7.23975 16.3459 6.37937 16.3099 5.44679C16.3099 5.06173 17.5993 4.06898 18.1091 4.24347C19.5064 4.97749 19.5903 7.25178 21.3475 5.98829C23.1046 4.7248 22.1211 5.74161 22.247 5.32646C22.5169 4.42396 21.8272 3.52147 22.1271 2.67914C22.2725 2.43167 22.4849 2.23072 22.7398 2.09971C22.9946 1.96869 23.2812 1.91299 23.5664 1.9391C23.7481 1.954 23.9227 2.01697 24.0723 2.12161C24.2219 2.22625 24.3412 2.3688 24.418 2.53474C25.1196 3.8584 25.0177 5.05571 27.0027 4.52023C27.8949 4.27957 27.7643 4.12313 27.8543 3.70799C27.9802 3.10632 28.0582 2.37831 28.2261 1.82478C28.2851 1.6301 28.3972 1.45588 28.5499 1.32189C28.7025 1.1879 28.8895 1.09949 29.0897 1.06669C29.387 1.01844 29.688 0.996291 29.9892 1.00051Z" stroke="#000000" stroke-width="2" stroke-miterlimit="10"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M25.825 8.86957C26.6974 8.89639 27.4454 9.1434 28.0151 9.66755C28.5726 10.1805 28.8434 10.8534 28.9822 11.5036C29.1201 12.1496 29.1459 12.862 29.1442 13.5461C29.1434 13.8751 29.1359 14.2133 29.1285 14.5453L29.1273 14.5984C29.1195 14.9512 29.1122 15.2988 29.1122 15.645V18.554C29.1231 18.9813 28.9953 19.4012 28.7473 19.7501L28.7341 19.7687L28.7201 19.7866C28.2859 20.342 27.6204 20.607 27.1857 20.7636C26.9884 20.8347 26.8236 20.8893 26.6811 20.9366C26.4246 21.0217 26.2406 21.0827 26.0698 21.1723L26.0548 21.1836L23.4415 23.0001L23.4385 23.0022C23.0998 23.2358 22.6997 23.3643 22.2882 23.3714L22.266 23.3718L22.2439 23.3712C21.6482 23.355 21.1761 23.1102 20.8565 22.9065C20.7096 22.8129 20.5739 22.7137 20.4723 22.6395C20.4636 22.6331 20.4551 22.6269 20.4469 22.621C20.3277 22.534 20.2687 22.4931 20.2279 22.4698L20.2186 22.4645L15.0675 19.4498L14.9749 19.3562C14.5062 18.8818 14.214 18.3424 14.1064 17.7617C14 17.1878 14.0867 16.6434 14.2616 16.1696C14.5971 15.2607 15.2896 14.5156 15.8806 14.0383C17.6102 12.5076 19.5366 11.2162 21.6083 10.1988L21.6249 10.1906L21.7895 10.1173L25.066 8.98501C25.3095 8.89942 25.567 8.86025 25.825 8.86957ZM25.7221 10.8743L22.5247 11.9793L22.4735 12.0021C20.562 12.9427 18.7847 14.1362 17.1893 15.5509L17.1704 15.5676L17.1507 15.5834C16.7086 15.9372 16.3038 16.4127 16.1379 16.8622C16.0601 17.0727 16.0452 17.2481 16.0729 17.3973C16.0958 17.521 16.1572 17.6784 16.3177 17.8642L21.2249 20.736C21.3748 20.8222 21.5191 20.9275 21.6212 21.0019L21.6412 21.0166C21.7527 21.0979 21.8402 21.1618 21.9314 21.2199C22.098 21.3261 22.2005 21.3615 22.2704 21.3699C22.2816 21.3675 22.2924 21.363 22.3023 21.3563L24.883 19.5625C24.9614 19.5046 25.044 19.4525 25.1301 19.4068L25.1328 19.4053C25.4576 19.234 25.8967 19.0877 26.2286 18.9771C26.3352 18.9416 26.4307 18.9097 26.5078 18.882C26.8733 18.7503 27.0404 18.6511 27.1122 18.588L27.1122 15.645C27.1122 15.2737 27.12 14.9052 27.1278 14.5541L27.1288 14.5074C27.1363 14.1697 27.1434 13.8497 27.1442 13.541C27.1459 12.8862 27.1177 12.3498 27.0262 11.9211C26.9356 11.4966 26.8016 11.2688 26.6609 11.1394C26.5331 11.0218 26.2906 10.8844 25.7613 10.8686L25.7529 10.8683C25.7448 10.868 25.7367 10.8692 25.729 10.8719L25.7221 10.8743Z" fill="#000"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M35.3272 9.02922C35.5992 8.91669 35.8927 8.86417 36.1876 8.87579L36.1914 8.87594C38.1686 8.96144 40.1812 9.82266 41.8947 10.8213C43.6256 11.8301 45.1489 13.0373 46.1684 13.9299L46.1697 13.9311C46.1864 13.9458 46.2036 13.9609 46.2213 13.9764C46.6348 14.339 47.3158 14.9361 47.7351 15.6897C47.9643 16.1017 48.1388 16.5976 48.1398 17.1612C48.1409 17.7332 47.9629 18.3002 47.6032 18.8438C47.3011 19.3007 46.8307 19.695 46.371 20.021C45.8936 20.3595 45.3399 20.6845 44.7926 20.9828C44.2492 21.279 43.6905 21.5605 43.1946 21.8103L43.1785 21.8184C42.6787 22.0702 42.2582 22.2824 41.9472 22.4586C41.9071 22.4849 41.85 22.5276 41.7358 22.6132C41.6257 22.6957 41.4774 22.8064 41.3106 22.9122C40.9861 23.118 40.4931 23.3713 39.8854 23.3715C39.4581 23.3722 39.0423 23.2359 38.6984 22.9832L36.3687 21.334L36.2996 21.2911C36.1795 21.2301 36.0107 21.1661 35.769 21.0851C35.7115 21.0659 35.6484 21.0452 35.5817 21.0233C35.381 20.9576 35.1472 20.8809 34.9311 20.7987C34.3956 20.5948 33.5463 20.2139 33.177 19.3455C33.0615 19.0739 33.0171 18.7271 32.9917 18.4615C32.9623 18.1546 32.9458 17.7878 32.9385 17.3922C32.9237 16.5987 32.9447 15.6352 32.9873 14.6943C33.0299 13.7528 33.0948 12.8181 33.1698 12.0807C33.2072 11.7137 33.2484 11.3827 33.2928 11.1191C33.3149 10.9883 33.3401 10.8595 33.3698 10.7444C33.3908 10.663 33.4412 10.4723 33.5518 10.2974L33.5761 10.2589L33.6038 10.2228C34.0401 9.65433 34.6428 9.23707 35.3272 9.02922ZM39.8854 23.3715H39.8844L39.8864 23.3715L39.8854 23.3715ZM36.1089 10.8742C36.1025 10.874 36.0961 10.8752 36.0901 10.878L36.0164 10.9123L35.9381 10.9342C35.6897 11.0038 35.4652 11.1396 35.288 11.3262C35.2811 11.3601 35.2734 11.4017 35.265 11.4515C35.2309 11.6537 35.1949 11.9362 35.1596 12.2833C35.0892 12.9741 35.0266 13.87 34.9853 14.7846C34.9439 15.6999 34.9244 16.618 34.9381 17.355C34.945 17.7247 34.96 18.0353 34.9826 18.271C35.0022 18.4757 35.0225 18.5623 35.0239 18.5749C35.0534 18.6228 35.1754 18.7517 35.6427 18.9295C35.8112 18.9937 35.9773 19.0481 36.1635 19.1092C36.2399 19.1342 36.3196 19.1603 36.4043 19.1887C36.6676 19.2769 36.9843 19.3888 37.2677 19.5404L37.2961 19.5557L37.475 19.6668L39.8727 21.364L39.8827 21.3715L39.8844 21.3715C39.936 21.3715 40.0423 21.3482 40.2394 21.2232C40.3334 21.1636 40.4264 21.0952 40.536 21.0131C40.5451 21.0062 40.5547 20.999 40.5647 20.9915C40.6564 20.9225 40.7831 20.8272 40.903 20.7525L40.9195 20.7423L40.9363 20.7327C41.3014 20.5246 41.7776 20.2846 42.2676 20.0378L42.2823 20.0304C42.7861 19.7766 43.3206 19.5073 43.8354 19.2267C44.3533 18.9445 44.8292 18.6625 45.2141 18.3896C45.6167 18.1041 45.8411 17.8825 45.9349 17.7408C46.1027 17.4873 46.1401 17.2997 46.1398 17.1649C46.1395 17.0215 46.0963 16.8578 45.9874 16.6621C45.7485 16.2328 45.3133 15.841 44.8503 15.4341C43.8907 14.594 42.4728 13.4731 40.8876 12.5492C39.2847 11.615 37.6062 10.939 36.105 10.8741L36.0164 10.9123L36.1089 10.8742ZM35.3143 11.2169C35.3143 11.2169 35.3131 11.222 35.31 11.2305C35.3127 11.2209 35.3143 11.2169 35.3143 11.2169Z" fill="#000"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M30.3447 22.0454C33.3355 22.0503 35.6899 23.0273 37.3351 24.5928C38.9717 26.15 39.8469 28.2333 39.9872 30.3512C40.2683 34.5947 37.592 39.0703 32.0996 39.9583C28.7311 40.513 25.7692 38.929 23.9725 36.5142C22.1816 34.1071 21.474 30.7818 22.6707 27.7121L22.6748 27.7016C23.5797 25.4555 25.3339 23.6587 27.5555 22.7042L27.5982 22.6859L27.8606 22.601L29.8172 22.1117C29.9863 22.0693 30.1605 22.0469 30.3348 22.0454L30.3447 22.0454ZM30.3052 24.0513L30.3038 24.0516L28.4117 24.5247L28.3038 24.5597C26.5898 25.3088 25.2351 26.7026 24.5321 28.4438C23.6206 30.7876 24.1427 33.3924 25.5771 35.3203C27.0066 37.2416 29.2676 38.3981 31.7757 37.9847L31.7789 37.9842C36.1564 37.2771 38.2112 33.7993 37.9915 30.4834C37.8815 28.8214 37.1982 27.2232 35.9565 26.0417C34.7246 24.8695 32.8833 24.051 30.3484 24.0454C30.3339 24.0458 30.3194 24.0477 30.3052 24.0513Z" fill="#000"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.2103 22.9886C11.4756 22.8901 11.7588 22.848 12.042 22.8656L12.0454 22.8658C13.2588 22.9452 14.422 23.5172 15.3735 24.0886C15.8604 24.381 16.3235 24.6933 16.7354 24.9734C16.7695 24.9966 16.8032 25.0195 16.8365 25.0422C17.1921 25.2841 17.498 25.4922 17.7698 25.659C18.3865 25.9343 18.9762 26.2668 19.5312 26.6524L19.6148 26.7104L19.685 26.7842C19.8882 26.9976 20.0426 27.2525 20.1379 27.5312C20.2299 27.8002 20.2647 28.0854 20.2403 28.3684L20.0809 31.6372C20.0853 31.8676 20.1283 32.1035 20.1856 32.4179C20.206 32.5293 20.2281 32.6507 20.2509 32.7851C20.3224 33.2061 20.4255 33.8762 20.1989 34.4916C20.1136 34.7232 19.966 34.8931 19.8902 34.9758C19.7952 35.0794 19.686 35.1791 19.5779 35.2703C19.3602 35.4541 19.083 35.6576 18.7788 35.8663C18.1664 36.2865 17.3764 36.774 16.573 37.2397C15.7683 37.7061 14.9343 38.1597 14.2301 38.5108C13.8786 38.686 13.5508 38.8401 13.2701 38.9585C13.0145 39.0664 12.7221 39.1779 12.4722 39.2221C11.7694 39.3465 11.1195 39.279 10.5549 38.9815C9.99859 38.6884 9.63544 38.2298 9.39183 37.7737C9.15177 37.3242 9.00219 36.8294 8.89321 36.3882C8.82598 36.1159 8.7625 35.8098 8.70638 35.5391C8.67628 35.3939 8.6483 35.2589 8.62299 35.1449L8.62196 35.1403C8.31092 33.7068 8.15838 31.4945 8.24707 29.4202C8.29166 28.3772 8.39836 27.3388 8.58715 26.4277C8.77039 25.5435 9.05223 24.6692 9.51284 24.0419L9.55205 23.9885L9.59796 23.9408C10.039 23.482 10.5965 23.1528 11.2103 22.9886ZM11.9182 24.8617C11.9139 24.8615 11.9095 24.8622 11.9053 24.8639L11.833 24.8943L11.7569 24.913C11.5058 24.9747 11.2752 25.101 11.0876 25.2793C10.897 25.5673 10.7012 26.0822 10.5455 26.8336C10.3852 27.6074 10.2869 28.5323 10.2452 29.5056C10.1616 31.4628 10.3116 33.494 10.576 34.714C10.6147 34.8882 10.6475 35.0476 10.6792 35.2017C10.728 35.4388 10.7742 35.6631 10.8349 35.9086C10.9294 36.2915 11.0317 36.5988 11.156 36.8314C11.2767 37.0575 11.3903 37.161 11.4873 37.2122C11.576 37.2589 11.7556 37.3177 12.1226 37.2529C12.1226 37.2529 12.1505 37.2464 12.2163 37.2237C12.2868 37.1994 12.3788 37.1638 12.4927 37.1158C12.7206 37.0197 13.0075 36.8856 13.3377 36.721C13.9966 36.3924 14.7931 35.9597 15.5701 35.5093C16.3485 35.0581 17.0915 34.5985 17.6474 34.2171C17.9273 34.0251 18.143 33.8642 18.2877 33.7421C18.3063 33.7264 18.3227 33.7122 18.3371 33.6994C18.3414 33.5997 18.3307 33.4237 18.2791 33.1199C18.2675 33.0516 18.2532 32.974 18.2375 32.8895C18.1719 32.5347 18.0836 32.0577 18.0806 31.6261L18.0804 31.5982L18.245 28.2231L18.2475 28.1979C17.8217 27.9143 17.3721 27.6683 16.9037 27.4628L16.8442 27.4367L16.7886 27.4032C16.4544 27.2014 16.0862 26.9508 15.7209 26.7022C15.6842 26.6772 15.6475 26.6522 15.6109 26.6273C15.199 26.3473 14.7775 26.0636 14.3439 25.8032C13.4542 25.269 12.6324 24.9085 11.9148 24.8615L11.9182 24.8617Z" fill="#000"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M50.0795 22.8635C50.5651 22.8586 51.0457 22.9632 51.4855 23.1697C51.9324 23.3796 52.3253 23.689 52.6344 24.074L52.6478 24.0907L52.6604 24.1079C53.249 24.909 53.5869 26.231 53.7731 27.5796C53.967 28.9839 54.021 30.6149 53.9207 32.1852C53.8211 33.7464 53.5654 35.3076 53.1072 36.5482C52.68 37.7046 51.9324 38.9636 50.6086 39.2245L50.5955 39.2271L50.5822 39.2294C49.5249 39.4084 48.583 39.0051 47.8987 38.6084C47.5472 38.4046 47.2247 38.179 46.9559 37.9876C46.9142 37.9579 46.8744 37.9294 46.8362 37.9022C46.6114 37.7416 46.4448 37.6226 46.2995 37.5348L46.2982 37.534C46.1012 37.4144 45.7933 37.2595 45.3785 37.0509L45.3586 37.0409C44.9543 36.8375 44.4783 36.5971 44.0226 36.3357C43.5722 36.0774 43.101 35.776 42.717 35.4394C42.3611 35.1274 41.9279 34.6557 41.8148 34.0287C41.6909 33.3407 41.8453 32.6482 41.9543 32.1597C41.9621 32.1249 41.9696 32.0912 41.9768 32.0586C42.1017 31.4907 42.1734 31.0892 42.1113 30.6996L42.1109 30.6968C42.0876 30.5483 42.0525 30.3721 42.0094 30.1553L42.0022 30.119C41.9577 29.8956 41.9071 29.639 41.8671 29.3821C41.8274 29.1269 41.794 28.8467 41.7895 28.573C41.7851 28.3106 41.8052 27.9862 41.9169 27.6736C42.0425 27.3203 42.2948 27.0402 42.4907 26.8506C42.7089 26.6394 42.9751 26.4304 43.2571 26.2306C43.8231 25.8297 44.5378 25.406 45.2671 25.0052C46.7272 24.2026 48.3387 23.4407 49.1628 23.0607C49.4489 22.9247 49.7628 22.8572 50.0795 22.8635ZM50.0401 24.8631C50.0336 24.8629 50.0271 24.8642 50.0211 24.8672L50.0137 24.8707L50.0064 24.8741C49.1973 25.2471 47.6319 25.9875 46.2305 26.7578C45.5272 27.1444 44.8885 27.5259 44.4134 27.8625C44.1749 28.0315 43.9986 28.1745 43.8817 28.2877C43.8391 28.3289 43.8119 28.359 43.7957 28.3781C43.792 28.4082 43.7879 28.4602 43.7892 28.5398C43.7916 28.6836 43.8103 28.8626 43.8433 29.0744C43.876 29.2845 43.9188 29.5029 43.9637 29.7286C43.967 29.7452 43.9703 29.7619 43.9737 29.7787C44.0138 29.9799 44.0566 30.1951 44.0866 30.3861C44.215 31.1933 44.0504 31.9412 43.9327 32.4763L43.9301 32.4883C43.7984 33.0867 43.7388 33.3973 43.78 33.6554C43.7846 33.6598 43.8295 33.7549 44.0354 33.9354C44.2721 34.1429 44.6105 34.3672 45.0177 34.6008C45.4195 34.8313 45.8492 35.0489 46.2574 35.2542C46.2821 35.2666 46.3069 35.2791 46.3317 35.2916C46.696 35.4747 47.0679 35.6616 47.3353 35.8239C47.552 35.955 47.7918 36.1266 48.0097 36.2825C48.0459 36.3084 48.0815 36.3339 48.1163 36.3586C48.3794 36.546 48.6371 36.7247 48.9018 36.8782C49.442 37.1913 49.8718 37.3155 50.2326 37.26C50.4386 37.212 50.841 36.9113 51.2311 35.8552C51.5969 34.8648 51.8318 33.5154 51.9248 32.0578C52.0173 30.6092 51.9659 29.1131 51.7919 27.8532C51.613 26.5576 51.3266 25.6851 51.061 25.3092C50.9448 25.1694 50.7995 25.0571 50.6355 24.9801C50.465 24.9001 50.2788 24.8602 50.0909 24.8635L50.0655 24.864L50.0401 24.8631Z" fill="#000"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M21.8161 38.7867C22.0805 38.7353 22.3525 38.7376 22.616 38.7933L22.6288 38.796L22.6415 38.7991C23.5612 39.0189 24.398 39.5918 25.055 40.0614C25.1612 40.1373 25.263 40.2107 25.3609 40.2813C25.94 40.6986 26.3853 41.0195 26.8064 41.1954L26.8094 41.1966C26.9339 41.2491 27.0619 41.2915 27.2306 41.3473C27.2433 41.3515 27.2563 41.3558 27.2695 41.3602C27.4394 41.4165 27.6655 41.4919 27.8836 41.5971C28.3771 41.8348 28.871 42.2474 29.0684 43.0111C29.1209 43.2145 29.1457 43.4862 29.1619 43.7257C29.1798 43.9923 29.1922 44.316 29.2001 44.6714C29.2159 45.3836 29.2145 46.254 29.1997 47.1111C29.185 47.9681 29.1567 48.8221 29.1179 49.5014C29.0986 49.8399 29.0762 50.1445 29.0504 50.3884C29.0376 50.5097 29.0229 50.626 29.0055 50.729C28.9916 50.8116 28.9651 50.9563 28.9105 51.0947L28.9082 51.1007C28.5774 51.9239 27.9445 52.5897 27.1385 52.9602L27.1127 52.972L27.0863 52.9824C26.2308 53.3182 25.3649 53.18 24.7129 52.9909C24.2562 52.8585 23.7668 52.652 23.4242 52.5075C23.3037 52.4566 23.2014 52.4135 23.1249 52.3838C20.4582 51.3748 17.9979 49.8854 15.8653 47.9891C15.8209 47.9505 15.7669 47.9055 15.7058 47.8546C15.4075 47.6058 14.9413 47.217 14.6045 46.7548C14.1418 46.1199 13.8479 45.2747 14.1179 44.2221C14.3123 43.4586 14.8586 42.8514 15.4083 42.3864C15.9771 41.9052 16.6783 41.4703 17.3742 41.0818C17.9418 40.7649 18.5397 40.4607 19.0918 40.1798C19.2184 40.1154 19.3426 40.0522 19.4634 39.9904C20.1318 39.6485 20.6855 39.3543 21.0794 39.0908L20.6547 39.3531L21.0771 39.0924C21.3005 38.9421 21.5517 38.8381 21.8161 38.7867ZM22.199 40.7498L22.1978 40.7499L22.1935 40.7518L22.1913 40.7533C21.6856 41.0915 21.0294 41.4358 20.3743 41.7709C20.2449 41.8371 20.1149 41.9033 19.9846 41.9696C19.4345 42.2495 18.8796 42.5319 18.3491 42.8281C17.6912 43.1954 17.1218 43.5565 16.7 43.9134C16.2597 44.2858 16.0961 44.5575 16.0559 44.7161L16.0552 44.7191C15.9594 45.0925 16.0433 45.3333 16.2208 45.5768C16.398 45.82 16.6175 46.005 16.8994 46.2427C16.9876 46.3169 17.0818 46.3964 17.1827 46.4843L17.1905 46.4911C19.1427 48.2278 21.395 49.5914 23.8361 50.5146L23.8429 50.5171C24.0219 50.5863 24.1854 50.6557 24.3444 50.7231C24.6448 50.8506 24.9288 50.9711 25.27 51.0701C25.7429 51.2073 26.0844 51.2176 26.3307 51.13C26.6425 50.9787 26.8913 50.721 27.0324 50.4024C27.0324 50.4024 27.033 50.3986 27.0334 50.3965C27.0413 50.3495 27.051 50.2777 27.0615 50.178C27.0825 49.9799 27.1027 49.7113 27.1212 49.3876C27.158 48.7425 27.1855 47.9163 27.2 47.0766C27.2145 46.2371 27.2157 45.3942 27.2006 44.7158C27.193 44.3759 27.1815 44.085 27.1664 43.86C27.15 43.6162 27.133 43.5176 27.132 43.5118C27.1239 43.4805 27.1166 43.4655 27.1144 43.4613L27.1129 43.4588L27.1124 43.458C27.1124 43.458 27.1071 43.4522 27.0933 43.4425C27.0786 43.4323 27.0543 43.4175 27.0154 43.3988C26.9292 43.3572 26.8193 43.318 26.6404 43.2587C26.6252 43.2536 26.6094 43.2484 26.5931 43.2431C26.4377 43.1918 26.2355 43.125 26.0341 43.0402C25.3803 42.7669 24.7156 42.2849 24.1568 41.8797C24.0655 41.8135 23.977 41.7493 23.8919 41.6885C23.2191 41.2075 22.6827 40.8717 22.199 40.7498Z" fill="#000"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M40.1579 38.7975C40.9369 38.9223 41.5731 39.2543 42.0885 39.5823C42.3255 39.7332 42.5511 39.8927 42.7495 40.033C42.7657 40.0444 42.7817 40.0557 42.7975 40.0669C43.0129 40.2191 43.1943 40.3456 43.3686 40.4515C43.6524 40.6153 43.998 40.779 44.4137 40.9759L44.449 40.9927C44.8672 41.1908 45.3428 41.4174 45.7953 41.6785C46.6626 42.1793 47.6836 42.9376 48.0202 44.1721C48.3294 45.258 48.0161 46.1417 47.5377 46.7969C47.1758 47.2925 46.6785 47.7007 46.3621 47.9604C46.3028 48.0091 46.2499 48.0526 46.2054 48.0904L46.2035 48.092C44.11 49.863 41.7551 51.2974 39.2229 52.344L39.2158 52.347C39.1358 52.3793 39.0286 52.4263 38.9029 52.4814C38.5654 52.6295 38.0936 52.8364 37.6511 52.9774C37.0111 53.1812 36.1766 53.3454 35.3283 53.1035L35.3016 53.0959L35.2754 53.0868C34.8396 52.936 34.4396 52.6968 34.1002 52.3844C33.7609 52.0719 33.4895 51.6929 33.3028 51.2711L33.297 51.258L33.2916 51.2448C33.1977 51.0152 33.1527 50.7056 33.1241 50.4785C33.0897 50.2058 33.0599 49.8707 33.0347 49.5015C32.9842 48.761 32.9491 47.8431 32.9354 46.9307C32.9218 46.0193 32.9291 45.098 32.9654 44.3528C32.9834 43.9819 33.0093 43.6389 33.0462 43.3562C33.0646 43.2153 33.0875 43.0748 33.1175 42.9459C33.1433 42.8349 33.1904 42.6585 33.2846 42.4902L33.2867 42.4864C33.5192 42.0751 33.8761 41.7965 34.1874 41.6055C34.5062 41.4099 34.8612 41.2563 35.1815 41.1311C35.3771 41.0547 35.5975 40.975 35.7967 40.9029C35.9083 40.8626 36.0133 40.8246 36.1035 40.791C36.3695 40.6919 36.5612 40.6115 36.6936 40.5397L36.7555 40.4973L38.5827 39.1478L38.6246 39.1184C39.076 38.8195 39.6245 38.7046 40.1579 38.7975ZM39.7398 40.7795L37.9158 42.1266L37.7542 42.2375L37.7191 42.2577C37.4321 42.4222 37.0968 42.5552 36.8021 42.665C36.6697 42.7144 36.5482 42.7582 36.431 42.8004C36.2552 42.8638 36.089 42.9238 35.9096 42.9939C35.6257 43.1049 35.4004 43.2077 35.2331 43.3103C35.1393 43.3679 35.0857 43.4122 35.0569 43.4396C35.0487 43.4816 35.0392 43.5393 35.0294 43.6148C35.0025 43.8215 34.9798 44.1042 34.963 44.45C34.9295 45.138 34.9219 46.0138 34.9352 46.9007C34.9485 47.7864 34.9825 48.6679 35.0301 49.3652C35.054 49.7149 35.0806 50.0083 35.1084 50.2283C35.1308 50.4061 35.1484 50.4862 35.1511 50.5036C35.2258 50.6581 35.3289 50.797 35.4549 50.913C35.5852 51.033 35.7373 51.126 35.9026 51.1872C36.1904 51.2611 36.5652 51.2242 37.0442 51.0717C37.3859 50.9629 37.6689 50.838 37.9647 50.7074C38.1232 50.6375 38.2855 50.5659 38.4624 50.4943C40.8012 49.5272 42.9766 48.202 44.9108 46.5659C44.9962 46.4934 45.078 46.4254 45.1563 46.3604C45.4683 46.1014 45.7244 45.8887 45.9225 45.6175C46.1206 45.3461 46.2028 45.0893 46.0957 44.7165L46.0935 44.7089L46.0914 44.7011C45.9761 44.2737 45.5753 43.8609 44.7953 43.4106C44.4231 43.1957 44.0179 43.0015 43.5927 42.8001C43.5696 42.7891 43.5463 42.7781 43.5229 42.767C43.1344 42.5831 42.7171 42.3856 42.3575 42.1771L42.3494 42.1724L42.3414 42.1676C42.0954 42.0188 41.8569 41.8512 41.6434 41.7003C41.6298 41.6907 41.6162 41.6811 41.6027 41.6716C41.3965 41.5258 41.2089 41.3932 41.0147 41.2696C40.6057 41.0093 40.2345 40.8343 39.8364 40.7715L39.8259 40.7698L39.8154 40.7679C39.7897 40.7633 39.7632 40.7673 39.7398 40.7795Z" fill="#000"/>
                </svg>
            </div>

            <nav>
                <ul class="header-list">
                    <li class="list-items"><a class="items-ref" href="main.php">Vessel</a></li>
                    <li class="list-items-sel">
                        <select class="select-vessel" name="vessel" id="vessel">
                            <option value="SOME VESSEL"></option>
                        </select>
                    </li>
                    <li class="list-items"><a class="items-ref sound-reference" href="sounding.php" id="itemSoundigInHeader">Sounding</a></li>
                    <li class="list-items"><a class="items-ref" href="drawing.php">Report</a></li>
                    <li class="list-items"><a class="items-ref" href="configuration.php">Config</a></li>
                    <li class="list-items"><a class="items-ref" href="tables.php">Tables</a></li>
                    <li class="list-items"><a class="items-ref" href="particular.php">Help</a></li>
<!--                    --><?// if ($this->role === 'Admin'): ?>
                        <li class="list-items" id="itemAdmin"><a class="items-ref" href="admin.php">Admin</a></li>
<!--                    --><?// endif; ?>

                    <li class="list-items item-icon"><a class="items-ref icon" onclick="myFunction()" href="#">&#9776;</a></li>

                </ul>
            </nav>

        </div>
        <div class="auth">

        </div>
    </div>
    <div class="mobil-menu">
        <ul class="mobil-header-list">
            <li style="padding: 0; background: rgb(23, 45, 65)"><div class="auth-mobil"></div></li>

            <li class="list-items"><i class="fa fa-ship" aria-hidden="true"></i><a class="items-ref" href="main.php">&nbsp; Vessel</a></li>
            <li class="list-items"><i class="fas fa-ruler-vertical" aria-hidden="true"></i><a class="items-ref sound-reference" href="sounding.php" id="itemSoundigInHeader">&nbsp; Sounding</a></li>
            <li class="list-items"><i class="fas fa-paste" aria-hidden="true"></i><a class="items-ref" href="drawing.php">&nbsp; Report</a></li>
            <li class="list-items"><i class="fas fa-clipboard-list" aria-hidden="true"></i><a class="items-ref" href="configuration.php">&nbsp; Config</a></li>
            <li class="list-items"><i class="fas fa-table" aria-hidden="true"></i><a class="items-ref" href="tables.php">&nbsp; Tables</a></li>
            <li class="list-items"><i class="fas fa-info-circle" aria-hidden="true"></i><a class="items-ref" href="particular.php">&nbsp; Help</a></li>
        </ul>
    </div>
