Dim fso
Set fso = CreateObject("Scripting.FileSystemObject")

' ディレクトリ作成の関数
Function CreateDirectoryIfNotExist(path)
    If Not fso.FolderExists(path) Then
        fso.CreateFolder(path)
    End If
End Function

' ファイルコピーの関数
Sub CopyFile(source, destination)
    fso.CopyFile source, destination & "\", True
End Sub

' フォルダルコピーの関数
Sub CopyFolder(source, destination)
    fso.CopyFolder source, destination & "\", True
End Sub

' メインプログラム
Dim appPath, web23Path, indexFolder, htaccessFile

' C:\appフォルダが無ければ作成する
appPath = "C:\app"
CreateDirectoryIfNotExist appPath

' C:\app\web23フォルダが無ければ作成する
web23Path = "C:\app\web23"
CreateDirectoryIfNotExist web23Path

' カレントフォルダにあるindexフォルダをC:\app\web23にコピーする
indexFolder = "index"
CopyFolder indexFolder, web23Path

' カレントフォルダにある.htaccessファイルをC:\app\web23にコピーする
htaccessFile = ".htaccess"
CopyFile htaccessFile, web23Path
