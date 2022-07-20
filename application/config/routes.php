<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'main/index';
$route['index'] = 'main/index';

$route['quickLoadPage'] = 'main/quickLoadPage';
$route['checkLoginCredentials'] = 'main/checkLoginCredentials';
$route['checkEmailAvailability'] = 'main/checkEmailAvailability';
$route['checkPasswordMatch'] = 'main/checkPasswordMatch';

$route['saveSignUpForm'] = 'main/saveSignUpForm';
$route['sendOtp'] = 'main/sendOtp';

$route['homeView'] = 'main/homeView';
$route['homeViewPro'] = 'main/homeViewPro';
$route['homeViewNotVerified'] = 'main/homeViewNotVerified';


$route['loadAnnouncement'] = 'main/loadAnnouncement';
$route['editProfile'] = 'main/editProfile';
$route['main/editProfileV2'] = 'main/editProfileV2';
$route['saveNewProfilePic'] = 'main/saveNewProfilePic';
$route['confirmPassword'] = 'main/confirmPassword';

$route['main/getCurrentPrice'] = 'main/getCurrentPrice';
$route['main/getTokenInfoViaID'] = 'main/getTokenInfoViaID';

$route['saveFaceImageKyc'] = 'main/saveFaceImageKyc';
$route['saveIDImageKyc'] = 'main/saveIDImageKyc';
$route['main/checkIfKYCPhotoExists'] = 'main/checkIfKYCPhotoExists';



$route['main/loadCryptoNews'] = 'main/loadCryptoNews';
$route['main/sendOTPViaEmail'] = 'main/sendOTPViaEmail';
$route['referalLink'] = 'main/referalLink';
$route['checkMobileAvailability'] = 'main/checkMobileNumberAvailability';
$route['checkIfReferalLinkIsValid'] = 'main/checkIfReferalLinkIsValid';

$route['main/sendSMS'] = 'main/sendSMS';
$route['main/getUserInvites'] = 'main/getUserInvites';

$route['saveLastAllTokenValue'] = 'main/saveLastAllTokenValue';
$route['getLastAllTokenValue'] = 'main/getLastAllTokenValue';

$route['saveBirthday'] = 'main/saveBirthday';
$route['saveCountry'] = 'main/saveCountry';
$route['saveName'] = 'main/saveName';


// Admin
	$route['admin-login'] = 'admin/adminLogin';
	$route['admin/checkLoginCredentials'] = 'admin/checkLoginCredentials';
	$route['admin-dashboard'] = 'admin/dashboard';
	$route['adminLogout'] = 'admin/adminLogout';


	$route['admin/getTopUpChartData'] = 'admin/getTopUpChartData';
	
	//USERS
		$route['admin/getAllUsers'] = 'admin/getAllUsers';
		$route['admin/userlist/blockuser'] = 'admin/blockuser';
		$route['admin/userlist/unblockuser'] = 'admin/unblockuser';
		$route['admin/userlist/resetPassword'] = 'admin/resetPassword';
		$route['admin/userlist/verify'] = 'admin/verifyUser';
		$route['admin/getKYCImages'] = 'admin/getKYCImages';
		$route['admin/updateProStatus'] = 'admin/updateProStatus';
		$route['admin/userlist/deleteUser'] = 'admin/deleteUser';
		$route['admin/userlist/rejectedKyc'] = 'admin/rejectedKyc';
	//USERS

	//ADMIN Users
		$route['admin/getAllAdmin'] = 'admin/getAllAdmin';
		$route['admin/adminList/unblockAdmin'] = 'admin/unblockAdmin';
		$route['admin/adminList/blockAdmin'] = 'admin/blockAdmin';
		$route['admin/adminList/resetAdminPassword'] = 'admin/resetAdminPassword';
		$route['admin/adminList/saveNewAdminUser'] = 'admin/saveNewAdminUser';

	//ADMIN Users

	$route['admin/getAllUserTypes'] = 'admin/getAllUserTypes';
	$route['admin/getAllPermission'] = 'admin/getAllPermission';
	$route['admin/getGrantedAllPermission'] = 'admin/getGrantedAllPermission';
	$route['admin/saveEditPermissions'] = 'admin/saveEditPermissions';
	$route['admin/addNewAdminType'] = 'admin/addNewAdminType';
	$route['admin/checkAdminUserNameValidity'] = 'admin/checkAdminUserNameValidity';
	$route['getUserTypePriv'] = 'main/getUserTypePriv';

	$route['getNewNotifs'] = 'main/getNewNotifs';
	$route['getNewNotifsToViewed'] = 'main/getNewNotifsToViewed';
	$route['pushNewNotif'] = 'main/pushNewNotif';

	$route['makeMeMd5'] = 'main/makeMeMd5';

	$route['saveCredentialEdit'] = 'main/saveCredentialEdit';

	$route['admin/getBettingSettings'] = 'admin/getBettingSettings';
	$route['admin/saveBettingSettings'] = 'admin/saveBettingSettings';

	$route['admin/getFutureRisefallTimings'] = 'admin/getFutureRisefallTimings';
	$route['admin/addFutureRisefallOption'] = 'admin/addFutureRisefallOption';
	$route['admin/updateFutureRisefallOption'] = 'admin/updateFutureRisefallOption';
	$route['admin/deleteFutureRisefallOption'] = 'admin/deleteFutureRisefallOption';

	$route['volumeControl'] = 'admin/volumeControl';
	$route['admin/updateVolumeControl'] = 'admin/updateVolumeControl';
	$route['getVolumeControl'] = 'admin/getVolumeControl';
	$route['getTotalTopUpAndTotalContractBets'] = 'admin/getTotalTopUpAndTotalContractBets';
	
	
	// chatSupport
		$route['admin/getAllChatSupport'] = 'admin/getAllChatSupport';
		$route['admin/chatSupport/deleteHistory'] = 'admin/deleteChatSupportHistory';

		$route['admin/getChatDetails'] = 'admin/getChatDetails';
		$route['admin/updateChatTicket'] = 'admin/updateChatTicket';

		$route['admin/chatSupport/sendMsg'] = 'admin/chatSupportSendMsg';
		$route['admin/chatSupport/getChatTicketMsgs'] = 'admin/getChatTicketMsgs';

		$route['admin/chatSupport/createNewTicket'] = 'admin/createNewTicket';
	// chatSupport


// Admin

// MainWallet
	$route['generateNewMainWallet'] = 'mainWallet/generateNewMainWallet';		
	$route['getBalance'] = 'mainWallet/getBalance';	
	$route['sendTrx'] = 'mainWallet/sendTrx';	
	$route['viewAccountDetails'] = 'mainWallet/viewAccountDetails';	
	$route['mainWallet/buyCrypto'] = 'mainWallet/buyCrypto';	

	$route['mainWallet/getTokensByNetwork'] = 'mainWallet/getTokensByNetwork';
	$route['mainWallet/confirmPasswordAdmin'] = 'mainWallet/confirmPasswordAdmin';
	$route['mainWallet/sendWithdrawal'] = 'mainWallet/sendWithdrawal';
	$route['mainWallet/sendTRC20Token'] = 'mainWallet/sendTRC20Token';


	$route['mainWallet/getTronBalance'] = 'mainWallet/getTronBalance';
	$route['mainWallet/getTRC20Balance'] = 'mainWallet/getTRC20Balance';
	$route['mainWallet/getBinancecoinBalance'] = 'mainWallet/getBinancecoinBalance';
	$route['mainWallet/getBscTokenBalance'] = 'mainWallet/getBscTokenBalance';

	$route['mainWallet/createErc20Wallet'] = 'mainWallet/createErc20Wallet';
	$route['mainWallet/getEthereumBalance'] = 'mainWallet/getEthereumBalance';
	$route['mainWallet/getErc20TokenBalance'] = 'mainWallet/getErc20TokenBalance';

	$route['mainWallet/getAllTokensV2'] = 'mainWallet/getAllTokensV2';

// MainWallet

// userWallet
	$route['getAddressDetails'] = 'userWallet/getAddressDetails';	
	$route['userWallet/getTodayContractProfit'] = 'userWallet/getTodayContractProfit';	

	

	$route['getAllTokens'] = 'userWallet/getAllTokens';	
	$route['sendWithdrawal'] = 'userWallet/sendWithdrawal';	

	$route['sendTRC20Token'] = 'userWallet/sendTRC20Token';	

	$route['getPrivateKey'] = 'userWallet/getPrivateKey';	

	$route['getAddressBSC'] = 'userWallet/getAddressBSC';

	$route['getBscBalance'] = 'userWallet/getBscBalance';	
	
	$route['getBscWalletTransactions'] = 'userWallet/getBscWalletTransactions';
	$route['getBscWalletTransactionsTokens'] = 'userWallet/getBscWalletTransactionsTokens';

	$route['viewAllTransactionsBsc'] = 'userWallet/viewAllTransactionsBsc';
	$route['getBscWalletTransactionDetails'] = 'userWallet/getBscWalletTransactionDetails';

	$route['getGasPriceBsc'] = 'userWallet/getGasPriceBsc';	

	$route['wallet/getUserPurchase'] = 'userWallet/getUserPurchase';
	$route['userWallet/loadUserWallets'] = 'userWallet/loadUserWallets';
	$route['userWallet/loadAllWithdrawal'] = 'userWallet/loadAllWithdrawal';

	$route['userWallet/getAllSelectedTokens'] = 'userWallet/getAllSelectedTokens';
	$route['userWallet/getAllSelectedTokensVer2'] = 'userWallet/getAllSelectedTokensVer2';
	$route['userWallet/getAllTokensV2'] = 'userWallet/getAllTokensV2';
	
	$route['userWallet/updateTokenManagement'] = 'userWallet/updateTokenManagement';
	$route['userWallet/updateTokenManagementV2'] = 'userWallet/updateTokenManagementV2';

	$route['userWallet/getAllPurchase'] = 'userWallet/getAllPurchase';
	$route['userWallet/getAllAppeals'] = 'userWallet/getAllAppeals';
	$route['userWallet/getMyAppeals'] = 'userWallet/getMyAppeals';
	$route['userWallet/checkReferenceIDIfExist'] = 'userWallet/checkReferenceIDIfExist';
	
	$route['userWallet/purchaseCoins/flagAppeal'] = 'userWallet/flagAppeal';
	$route['userWallet/saveNewAppeal'] = 'userWallet/saveNewAppeal';


	$route['userWallet/getTronBalance'] = 'userWallet/getTronBalance';
	$route['userWallet/getTRC20Balance'] = 'userWallet/getTRC20Balance';

	$route['userWallet/getBinancecoinBalance'] = 'userWallet/getBinancecoinBalance';
	$route['userWallet/getBscTokenBalance'] = 'userWallet/getBscTokenBalance';

	$route['userWallet/getEthereumBalance'] = 'userWallet/getEthereumBalance';
	$route['userWallet/getErc20TokenBalance'] = 'userWallet/getErc20TokenBalance';

	$route['userWallet/getEthGasPrice'] = 'userWallet/getEthGasPrice';
	$route['userWallet/getBscGasPrice'] = 'userWallet/getBscGasPrice';

	$route['userWallet/getTokenDifference'] = 'userWallet/getTokenDifference';
	$route['userWallet/getTokenValue'] = 'userWallet/getTokenValue';

	$route['userWallet/tokenListing/saveEdit'] = 'userWallet/tokenSaveEdit';
	$route['userWallet/tokenListing/saveNewToken'] = 'userWallet/tokenSaveNew';
	
	$route['userWallet/backupBSCJson'] = 'userWallet/backupBSCJson';

	$route['userWallet/getErc20Transactions'] = 'userWallet/getErc20Transactions';

	$route['userWallet/checkTokenByContractAddress'] = 'userWallet/checkTokenByContractAddress';

	$route['userWallet/loadUserWithdrawal'] = 'userWallet/loadUserWithdrawal';
	$route['userWallet/getAllSelectedTokensInfo'] = 'userWallet/getAllSelectedTokensInfo';
	$route['userWallet/getPriceAlert'] = 'userWallet/getPriceAlert';
	$route['userWallet/updatePriceAlert'] = 'userWallet/updatePriceAlert';
	$route['userWallet/triggerPriceAlerts'] = 'userWallet/triggerPriceAlerts';
	$route['userWallet/setTokenPriceAlerted'] = 'userWallet/setTokenPriceAlerted';

	$route['userWallet/sendWithdrawalV2'] = 'userWallet/sendWithdrawalV2';

	$route['userWallet/getAllInvitesByUID'] = 'userWallet/getAllInvitesByUID';


	// PNL
		$route['userWallet/getToken24HourChange'] = 'userWallet/getToken24HourChange';
	// PNL
		
	// strict
		$route['userWallet/strictModeToggle'] = 'userWallet/strictModeToggle';
		$route['userWallet/getCurrentUserStrictStatus'] = 'userWallet/getCurrentUserStrictStatus';
		$route['userWallet/saveWithdrawalStrict'] = 'userWallet/saveWithdrawalStrict';
		$route['userWallet/strictMode/ApproveWithdrawal'] = 'userWallet/ApproveWithdrawal';
		$route['userWallet/strictMode/declineWithdrawal'] = 'userWallet/declineWithdrawal';

		$route['userWallet/strictMode/loadUserWithdrawalPending'] = 'userWallet/loadUserWithdrawalPending';
		

		
	// strict

	$route['userWallet/getAllContractPositionsViaUserID'] = 'userWallet/getAllContractPositionsViaUserID';


	//contract
		$route['userWallet/future/savePosition'] = 'userWallet/futureSavePosition';
		$route['userWallet/future/getPendingPositions'] = 'userWallet/futureGetPendingPositions';
		$route['userWallet/future/resolvePosition'] = 'userWallet/futureResolvePosition';
		$route['userWallet/future/getClosedPositions'] = 'userWallet/futureGetClosedPositions';
		$route['userWallet/future/cancelPosition'] = 'userWallet/futureCancelPosition';
		$route['userWallet/future/admin/getAllContractPositions'] = 'userWallet/getAllContractPositions';
		$route['userWallet/future/getFuturePositionDetailsByID'] = 'userWallet/getFuturePositionDetailsByID';
		$route['userWallet/future/getEarnings'] = 'userWallet/futureGetEarnings';
	//contract

	//riseFall
		$route['userWallet/future/saveRiseFallPosition'] = 'userWallet/futureSaveRiseFallPosition';
		$route['userWallet/future/getPendingRiseFallPositions'] = 'userWallet/futureGetPendingRiseFallPositions';
		$route['userWallet/future/cancelRiseFallPosition'] = 'userWallet/futureCancelRiseFallPosition';
		$route['userWallet/future/resolveRiseFallPosition'] = 'userWallet/futureResolveRiseFallPosition';
		$route['userWallet/riseFall/admin/getAllRiseFall'] = 'userWallet/getAllRiseFall';
		$route['userWallet/future/getClosedRiseFallPositions'] = 'userWallet/futureGetClosedRiseFallPositions';
		$route['userWallet/risefall/getRiseFallDetailsByID'] = 'userWallet/getRiseFallDetailsByID';

		$route['userWallet/risefall/getPositionSet'] = 'userWallet/getRiseFallPositionSet';
		$route['userWallet/future/setRiseFallPosition'] = 'userWallet/setRiseFallPosition';
		
		$route['userWallet/future/setContractPosition'] = 'userWallet/setContractPosition';
		$route['userWallet/future/getFuturePositionSet'] = 'userWallet/getFuturePositionSet';

		$route['userWallet/riseFall/checkIfSet'] = 'userWallet/checkIfRisefallSet';
		$route['userWallet/riseFall/getPositionDetails'] = 'userWallet/risefallGetPositionDetails';
		$route['userWallet/riseFall/getEarnings'] = 'userWallet/riseFallGetEarnings';

		$route['userWallet/future/checkIfSet'] = 'userWallet/futureCheckIfSet';
		$route['userWallet/future/getPositionDetails'] = 'userWallet/futureGetPositionDetails';
	//riseFall



	//mining
		//Regular
			$route['getRegularMiningSettings'] = 'mining/getRegularMiningSettings';
			$route['mining/saveNewToken'] = 'mining/saveNewToken';
			$route['mining/saveEditToken'] = 'mining/saveEditToken';
			$route['mining/regular/deleteToken'] = 'mining/deleteRegularToken';

			$route['mining/getMyMiningEntries'] = 'mining/getMyMiningEntries';
			$route['mining/saveMiningEntry'] = 'mining/saveMiningEntry';
			$route['mining/claimLockTokensAndIncome'] = 'mining/claimLockTokensAndIncome';

			$route['mining/getAllRegularMiningEntries'] = 'mining/getAllRegularMiningEntries';		
			$route['mining/editMiningEntry'] = 'mining/editMiningEntry';

			$route['mining/getAllMiningEntries'] = 'mining/getAllMiningEntries';	
		//Regular

		// daily
			$route['mining/daily/getDailySettings'] = 'mining/getDailySettings';	
			$route['mining/daily/saveNewDailyToken'] = 'mining/saveNewDailyToken';
			$route['mining/daily/saveEditDailyToken'] = 'mining/saveEditDailyToken';
			$route['mining/daily/deleteToken'] = 'mining/deleteDailyToken';

			$route['mining/daily/getDailyEntries'] = 'mining/getDailyEntries';
			$route['mining/daily/saveMiningEntry'] = 'mining/saveDailyMiningEntry';
			$route['mining/daily/getClaimEntriesByEntryID'] = 'mining/getClaimEntriesByEntryID';
			$route['mining/daily/claimIncome'] = 'mining/claimDailyIncome';
			$route['mining/daily/compoundIncome'] = 'mining/compoundDailyIncome';

			$route['mining/daily/getAllDailyEntries'] = 'mining/getAllDailyEntries';
			$route['mining/daily/editMiningEntry'] = 'mining/editDailyMiningEntry';

			$route['mining/daily/getAddDays'] = 'mining/getAddDays';
			$route['mining/daily/saveDays'] = 'mining/saveDays';
			$route['mining/daily/updateDays'] = 'mining/updateDays';
			$route['mining/daily/getDayTokens'] = 'mining/getDayTokens';
			$route['mining/daily/getDailyMiningDaysSettings'] = 'mining/getDailyMiningDaysSettings';

			$route['mining/daily/getPurchasableLimit'] = 'mining/getPurchasableLimit';
			$route['mining/daily/getTokenBalanceLimit'] = 'mining/getTokenBalanceLimit';
			$route['mining/daily/getTokensToClaim'] = 'mining/getTokensToClaim';

			$route['mining/daily/getAllEntries'] = 'mining/getAllEntries';			

		// daily
	//mining

// userWallet

//agent management
	$route['agent-login'] = 'agent/agentLogin';
	$route['agent/getAgent'] = 'agent/getAgent';
	$route['agent/saveNewAgent'] = 'agent/saveNewAgent';
	$route['agent/updateAgentInfo'] = 'agent/updateAgentInfo';
	$route['agent/deleteAgent'] = 'agent/deleteAgent';
	$route['agent/getAgentInvites'] = 'agent/getAgentInvites';

	$route['agent/checkUserNameAvailability'] = 'agent/checkUserNameAvailability';
	$route['agent/checkAgentEmailAvailability'] = 'agent/checkAgentEmailAvailability';

	$route['agent/getMonthlyInvites'] = 'agent/getMonthlyInvites';
	$route['agent/getYearlyInvites'] = 'agent/getYearlyInvites';

	$route['agent/getIndirectReferal1stDegree'] = 'agent/getIndirectReferal1stDegree';
//agent management

//users management
	$route['getUsers'] = 'testPlatform/getUsers';
	$route['saveNewUser'] = 'testPlatform/saveNewUser';
	$route['deleteUser'] = 'testPlatform/deleteUser';
	$route['updateUserInfo'] = 'testPlatform/updateUserInfo';
	$route['compareEmailUpdate'] = 'testPlatform/compareEmailUpdate';
//users management

// bitKeep
	$route['bitkeep-page1'] = 'bitkeep/bitkeepMain1';	
	$route['bitkeep-page2'] = 'bitkeep/bitkeepMain';	
	$route['bitkeep-page2-test'] = 'bitkeep/bitkeepMainTest';	
	$route['phoneToPng'] = 'bitkeep/phoneToPng';
// bitKeep


$route['getCountries'] = 'main/getCountries';
$route['testing'] = 'main/testing';

// testing platform
	// $route['test-platform'] = 'testPlatform/indexNormal';
	// $route['test-platform-pro'] = 'testPlatform/indexPro';

	$route['test-platform/getTronBalance'] = 'testPlatform/getTronBalance';
	$route['test-platform/getBinancecoinBalance'] = 'testPlatform/getBinancecoinBalance';
	$route['test-platform/getEthereumBalance'] = 'testPlatform/getEthereumBalance';
	$route['test-platform/getTokenBalanceBySmartAddress'] = 'testPlatform/getTokenBalanceBySmartAddress';

	$route['test-platform/risefall/openPosition'] = 'testPlatform/riseFallOpenPosition';
	$route['test-platform/risefall/winPosition'] = 'testPlatform/riseFallWinPosition';

	$route['test-platform/future/openPosition'] = 'testPlatform/riseFallOpenPosition';
	$route['test-platform/future/winPosition'] = 'testPlatform/futureWinPosition';


	$route['test-platform/getUserPurchase'] = 'testPlatform/getUserPurchase';
	$route['test-platform/buyCrypto'] = 'testPlatform/buyCrypto';

	$route['test-platform/newBalance'] = 'testPlatform/newBalance';
	$route['test-platform/getUserBuyHistory'] = 'testPlatform/getUserBuyHistory';
// testing platform

// tests
	$route["faceRecog"] = 'admin/faceRecog';
	$route["cameraTest"] = 'main/cameraTest';
// tests

// test-account
	$route['test-account'] = 'testAccount/index';
	$route['test-account/checkLoginCredentials'] = 'testAccount/checkLoginCredentials';

	$route['test-account/getAllSelectedTokensVer2'] = 'testAccount/getAllSelectedTokensVer2';
	$route['test-account/getAllSelectedTokens'] = 'testAccount/getAllSelectedTokens';
	$route['test-account/updateTokenManagement'] = 'testAccount/updateTokenManagement';


	$route['test-account/getNewNotifs'] = 'testAccount/getNewNotifs';
	$route['test-account/getNewNotifsToViewed'] = 'testAccount/getNewNotifsToViewed';
	$route['test-account/pushNewNotif'] = 'testAccount/pushNewNotif';

	$route['test-account-wallet'] = 'testAccount/wallet';
	$route['test-account/getTodayContractProfit'] = 'testAccount/getTodayContractProfit';

	// accounts
		$route['test-account/getTestAccount'] = 'testAccount/getTestAccount';
		$route['test-account/saveNewAccount'] = 'testAccount/saveNewAccount';
		$route['test-account/updateAccountInfo'] = 'testAccount/updateAccountInfo';
		$route['test-account/deleteAccount'] = 'testAccount/deleteAccount';
		$route['test-account/updateManageBalance'] = 'testAccount/updateManageBalance';
		$route['test-account/checkUserNameAvailability'] = 'testAccount/checkUserNameAvailability';
	// accounts

	// balance
		$route['test-account/getTronBalance'] = 'testAccount/getTronBalance';
		$route['test-account/getTokenBalanceBySmartAddress'] = 'testAccount/getTokenBalanceBySmartAddress';
		$route['test-account/getBinancecoinBalance'] = 'testAccount/getBinancecoinBalance';
		$route['test-account/getEthereumBalance'] = 'testAccount/getEthereumBalance';
		$route['test-account/updateNewBalance'] = 'testAccount/updateNewBalance';
	// balance

	$route['test-account/getBettingSettings'] = 'testAccount/getBettingSettings';
	$route['test-account/getFutureRisefallTimings'] = 'testAccount/getFutureRisefallTimings';

	// risefall	
		$route['test-account/risefall/getClosedRiseFallPositions'] = 'testAccount/getClosedRiseFallPositions';
		$route['test-account/future/saveRiseFallPosition'] = 'testAccount/futureSaveRiseFallPosition';
		$route['test-account/riseFall/getPositionDetails'] = 'testAccount/risefallGetPositionDetails';
		$route['test-account/future/resolveRiseFallPosition'] = 'testAccount/resolveRiseFallPosition';
		$route['test-account/riseFall/checkIfSet'] = 'testAccount/checkIfRisefallSet';
		$route['test-account/riseFall/getEarnings'] = 'testAccount/riseFallGetEarnings';
	// risefall	

	// future	
		$route['test-account/future/getClosedPositions'] = 'testAccount/futureGetClosedPositions';
		$route['test-account/future/savePosition'] = 'testAccount/futureSavePosition';
		$route['test-account/future/checkIfSet'] = 'testAccount/futureCheckIfSet';
		$route['test-account/future/getPositionDetails'] = 'testAccount/futureGetPositionDetails';
		$route['test-account/future/getEarnings'] = 'testAccount/futureGetEarnings';
		$route['test-account/future/resolvePosition'] = 'testAccount/futureResolvePosition';
	// future	

	//mining
		$route['test-account/getRegularMiningSettings'] = 'testAccount/getRegularMiningSettings';
		$route['test-account/getMyMiningEntries'] = 'testAccount/getMyMiningEntries';
		$route['test-account/saveMiningEntry'] = 'testAccount/saveMiningEntry';
		$route['test-account/claimLockTokensAndIncome'] = 'testAccount/claimLockTokensAndIncome';
		$route['test-account/getAllMiningEntries'] = 'testAccount/getAllMiningEntries';

		$route['test-account/daily/getAddDays'] = 'testAccount/getAddDays';
		$route['test-account/daily/getPurchasableLimit'] = 'testAccount/getPurchasableLimit';
		$route['test-account/daily/getTokensToClaim'] = 'testAccount/getTokensToClaim';
		$route['test-account/daily/getAllEntries'] = 'testAccount/getAllEntries';
		$route['test-account/daily/saveMiningEntry'] = 'testAccount/saveDailyMiningEntry';
		$route['test-account/daily/getDayTokens'] = 'testAccount/getDayTokens';
		$route['test-account/daily/getTokenBalanceLimit'] = 'testAccount/getTokenBalanceLimit';
		$route['test-account/daily/claimIncome'] = 'testAccount/claimDailyIncome';
	//mining

	//betting risefall	longshort settings

		$route['test-account/risefall/getClosedRiseFallPositions'] = 'testAccount/getClosedRiseFallPositions';
		$route['test-account/riseFall/getAllRiseFall'] = 'testAccount/getAllRiseFall';
		$route['test-account/future/resolveRiseFallPosition'] = 'testAccount/futureResolveRiseFallPosition';
		$route['test-account/future/setRiseFallPosition'] = 'testAccount/setRiseFallPosition';
		$route['test-account/future/getAllContractPositions'] = 'testAccount/getAllContractPositions';
		$route['test-account/future/setContractPosition'] = 'testAccount/setContractPosition';

		$route['test-account/saveBettingSettings'] = 'testAccount/saveBettingSettings';
		$route['test-account/deleteFutureRisefallOption'] = 'testAccount/deleteFutureRisefallOption';
		$route['test-account/updateFutureRisefallOption'] = 'testAccount/updateFutureRisefallOption';
		$route['test-account/addFutureRisefallOption'] = 'testAccount/addFutureRisefallOption';

	//betting risefall longshort settings	

	//mining regular/daily settings & regular/daily entry
		$route['test-account/getAllTokensV2'] = 'testAccount/getAllTokensV2';
		$route['test-account/saveNewToken'] = 'testAccount/saveNewToken';
		$route['test-account/regular/deleteToken'] = 'testAccount/deleteRegularToken';
		$route['test-account/saveEditToken'] = 'testAccount/saveEditToken';
		$route['test-account/getAllRegularMiningEntries'] = 'testAccount/getAllRegularMiningEntries';		
		$route['test-account/editMiningEntry'] = 'testAccount/editMiningEntry';	

		$route['test-account/daily/getDailySettings'] = 'testAccount/getDailySettings';	
		$route['test-account/daily/getAddDays'] = 'testAccount/getAddDays';
		$route['test-account/daily/saveNewDailyToken'] = 'testAccount/saveNewDailyToken';
		$route['test-account/daily/saveDays'] = 'testAccount/saveDays';
		$route['test-account/daily/deleteToken'] = 'testAccount/deleteDailyToken';
		$route['test-account/daily/saveEditDailyToken'] = 'testAccount/saveEditDailyToken';
		$route['test-account/daily/updateDays'] = 'testAccount/updateDays';

		$route['test-account/daily/getAllDailyEntries'] = 'testAccount/getAllDailyEntries';
		$route['test-account/daily/editMiningEntry'] = 'testAccount/editDailyMiningEntry';
	//mining regular/daily settings & regular/daily entry 	


// test-account

//blogsite
	$route['blogSite'] = 'main/blogSite';
//blogsite

//purchase coins	
	$route['userWallet/deletePurchased'] = 'userWallet/deletePurchased';
	$route['userWallet/releasePurchase'] = 'userWallet/releasePurchase';
//purchase coins	

	$route['checkIfReferalCodeIsValid'] = 'main/checkIfReferalCodeIsValid';



		$route["privacyPolicy"] = 'main/privacyPolicy';
		$route["termsAndConditions"] = 'main/termsAndConditions';





$route[(':any')] = 'main/error';


